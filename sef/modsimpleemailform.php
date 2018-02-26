<?php

class sefmodsimpleemailform implements sefv2formrendererinterface
{

    // Initialize vars
    protected $_msg          = '';
    protected $_output       = '';
    // NOTE to developers: just increase this number for more fields
    // BUT you will have to also increase the number of entries in mod_simpleemailform.xml
    protected $_maxFields    = 8;        // mixed From, Subject, text, textarea, dropdown select, radio, checkbox fields
    protected $_field        = array();
    protected $_badEmail     = '';
    protected $_fromField    = 1;
    protected $_subjectField = 2;
    protected $_fileMsg      = array();
    protected $_lang         = 'en-GB';
    protected $_transLang    = array();
    protected $_params       = array();
    protected $_testMode     = 'N';
    protected $_testInfo     = array();
    protected $_fieldPrefix  = 'mod_simpleemailform_field';
    protected $_csrfField    = 'mod_simpleemailform_field_oneTime_1';

    // 2011-12-03 DB: added CSS styling for elements
    // Used if CSS Class param is set
    protected $_tableClass      = '';
    protected $_trClass         = '';
    protected $_thClass         = '';
    protected $_tdClass         = '';
    protected $_spaceClass      = '';
    protected $_inputClass      = '';
    protected $_captchaClass    = '';

    // Init XML params
    protected $_cssClass        = '';
    protected $_labelAlign      = '';
    protected $_copymeLabel     = '';
    protected $_copymeActive    = 0;
    protected $_copymeAuto      = 0;
    protected $_errorTxtColor   = '';
    protected $_successTxtColor = '';
    protected $_anchor          = '';
    protected $_autoReset       = '';
    protected $_redirectURL     = '';
    protected $_col2space       = 0;
    protected $_uploadActive    = 0;
    protected $_uploadAllowed   = '';
    protected $_uploadLabel     = '';
    protected $_emailCheck      = '';
    protected $_addTitle        = 'N';
    protected $_instance        = 0;

    // Init CAPTCHA params
    protected $_useCaptcha          = 0;
    protected $_captchaDir          = '';
    protected $_captchaURL          = '';
    protected $_captchaLen          = 0;
    protected $_captchaSize         = 0;
    protected $_captchaWidth        = 0;
    protected $_captchaHeight       = 0;
    protected $_captchaTextColor    = '';
    protected $_captchaLinesColor   = '';
    protected $_captchaBgColor      = '';

    public function __construct($params)
    {
        if (!defined('MOD_SIMPLEEMAILFORM_DIR')) {
            define('MOD_SIMPLEEMAILFORM_DIR', dirname(dirname(__FILE__)));
        }

        // Get XML params
        $this->_cssClass        = $params->get('mod_simpleemailform_cssClass');
        $this->_labelAlign      = $params->get('mod_simpleemailform_labelAlign');
        $this->_copymeLabel     = $params->get('mod_simpleemailform_copymeLabel');
        $this->_copymeActive    = $params->get('mod_simpleemailform_copymeActive');
        $this->_copymeAuto      = $params->get('mod_simpleemailform_copymeAuto');
        $this->_errorTxtColor   = $params->get('mod_simpleemailform_errorTxtColor');
        $this->_successTxtColor = $params->get('mod_simpleemailform_successTxtColor');
        $this->_anchor          = $params->get('mod_simpleemailform_anchor');
        $this->_autoReset       = $params->get('mod_simpleemailform_autoreset');
        $this->_redirectURL     = $params->get('mod_simpleemailform_redirectURL');
        $this->_col2space       = $params->get('mod_simpleemailform_col2space');
        $this->_uploadActive    = $params->get('mod_simpleemailform_uploadActive');
        $this->_uploadAllowed   = $params->get('mod_simpleemailform_uploadAllowed');
        $this->_uploadLabel     = $params->get('mod_simpleemailform_uploadLabel');
        $this->_instance        = $params->get('mod_simpleemailform_instance');
        $this->_emailCheck      = $params->get('mod_simpleemailform_emailCheck');
        $this->_addTitle        = $params->get('mod_simpleemailform_addTitle');
        // test mode
        $this->_testMode        = $params->get('mod_simpleemailform_testMode');
        // error checking for all incoming params
        $this->_instance        = trim($this->_instance);
        $this->_redirectURL     = trim($this->_redirectURL);
        $this->_col2space       = (int) $this->_col2space;
        $this->_uploadActive    = (int) $this->_uploadActive;
        $this->_uploadAllowed   = strtolower(trim($this->_uploadAllowed));
        $this->_cssClass        = strip_tags(trim($this->_cssClass));
        $this->_cssClass        = ($this->_cssClass) ? $this->_cssClass : 'mod_sef';
        $this->_autoReset       = ($this->_autoReset  == 'Y') ? true : false;
        $this->_emailCheck      = ($this->_emailCheck == 'Y') ? true : false;
        $this->_addTitle        = ($this->_addTitle   == 'Y') ? true : false;
        // label alignment
        switch (strtoupper($this->_labelAlign)) {
            case 'C':
                $this->_labelAlign = 'center';
                break;
            case 'R':
                $this->_labelAlign = 'right';
                break;
            default:
                $this->_labelAlign = 'left';
        }
        // 2011-12-03 DB: init CSS class properties (if set)
        $this->_tableClass      = $this->_cssClass . "_table";
        $this->_trClass         = $this->_cssClass . "_tr";
        $this->_thClass         = $this->_cssClass . "_th";
        $this->_spaceClass      = $this->_cssClass . "_space";
        $this->_tdClass         = $this->_cssClass . "_td";
        $this->_inputClass      = $this->_cssClass . "_input";
        $this->_captchaClass    = $this->_cssClass . "_captcha";
        // Assign field params into array
        $this->_field = array();
        for ($x = 1; $x <= $this->_maxFields; $x++) {
            // build labels
            $activeLabel = $this->_fieldPrefix . $x . 'active';
            $valueLabel  = $this->_fieldPrefix . $x . 'value';
            $sizeLabel   = $this->_fieldPrefix . $x . 'size';
            $maxxlabel   = $this->_fieldPrefix . $x . 'maxx';
            $labelLabel  = $this->_fieldPrefix . $x . 'label';
            $fromLabel   = $this->_fieldPrefix . $x . 'from';
            $ckRfmtLabel = $this->_fieldPrefix . $x . 'ckRfmt';         // separator for radio / checkbox only
            $ckRposLabel = $this->_fieldPrefix . $x . 'ckRpos';         // label for radio / checkbox before or after only
            // 2010-12-12 DB: added check to see if any values + set defaults
            $a = trim($params->get($activeLabel));      // Yes / No / Required / Hidden
            $v = trim($params->get($valueLabel));
            $z = trim($params->get($sizeLabel));
            $m = trim($params->get($maxxlabel));
            $l = trim($params->get($labelLabel));
            $f = trim($params->get($fromLabel));        // From / Subject / Normal / textArea / Drop / Radio / Checkbox
            $s = trim($params->get($ckRfmtLabel));
            $p = trim($params->get($ckRposLabel));
            // all fields
            $this->_field[$x]['value']  = (isset($v)) ? $v : '';        // gets overwritten for Dropdown select / Radio / Checkbox
            $this->_field[$x]['size']   = (isset($z)) ? (int) $z : 40;  // gets overwritten for textarea fields
            $this->_field[$x]['error']  = '';
            $this->_field[$x]['maxx']   = (isset($m)) ? (int) $m : 255;
            $this->_field[$x]['label']  = (isset($l)) ? $l : $x . ':';
            $this->_field[$x]['ckRfmt'] = (isset($s) && stripos('-HVC', $s)) ? strtoupper($s) : 'C';
            $this->_field[$x]['ckRpos'] = (isset($p) && stripos('-BA', $p)) ? strtoupper($p) : 'A';
            // active
            if (isset($a) && $a) {
                $a = trim(strtoupper($a));
                if (strpos('-RYNH', $a)) {
                    $this->_field[$x]['active'] =  $a;
                } else {
                    $this->_field[$x]['active'] =  'N';
                }
            } else {
                $this->_field[$x]['active'] =  'N';
            }
            // from field (also used to determine field type only for active fields
            if (isset($f) && $f && $this->_field[$x]['active'] !== 'N') {
                $f = trim(strtoupper($f));
                // From Subject Normal textArea Dropdown Radio Checkbox User
                if (strpos('-FSNADRCU', $f)) {
                    $this->_field[$x]['from'] =  $f;
                    // identify "from" & "subject" fields
                    switch ($f) {
                        case 'F':  // From
                            $this->_fromField = $x;
                            break;
                        case 'S':  // Subject
                            $this->_subjectField = $x;
                            break;
                        case 'A':  // textArea
                            $this->_field[$x]['size']   = (isset($z) && strpos($z, ',')) ? $z : '4,40';
                            break;
                        case 'D':  // Dropdown select
                        case 'R':  // Radio
                        case 'C':  // Checkbox
                            // opts used for select / radio / checkbox fields
                            // overwrite 'value' with an array of value=visible key pairs
                            if (isset($v) && $v) {
                                if (strpos($v, ',')) {
                                    $vTmp = explode(',', $v);
                                } else {
                                    $vTmp = array($v);
                                }
                                $newArray = array();
                                foreach ($vTmp as $item) {
                                    if (strpos($item, '=')) {
                                        list($value, $visible) = explode('=', $item);
                                    } elseif ($item) {
                                        $value   = $item;
                                        $visible = $item;
                                    } else {
                                        $value   = '---';
                                        $visible = '---';
                                    }
                                    $newArray[trim($value)] = trim($visible);
                                }
                                $this->_field[$x]['value'] = $newArray;
                            } else {
                                $this->_field[$x]['value'] = array('---' => '---');
                            }
                            break;
                        default:
                            // nothing
                    }
                } else {
                    $this->_field[$x]['from'] =  'N';
                }
            } else {
                $this->_field[$x]['from'] =  'N';
            }
        }

        // Captcha
        $this->_useCaptcha          = $params->get('mod_simpleemailform_useCaptcha');
        $this->_captchaDir          = $params->get('mod_simpleemailform_captchaDir');
        $this->_captchaURL          = $params->get('mod_simpleemailform_captchaURL');
        $this->_captchaLen          = $params->get('mod_simpleemailform_captchaLen');
        $this->_captchaSize         = $params->get('mod_simpleemailform_captchaSize');
        $this->_captchaWidth        = $params->get('mod_simpleemailform_captchaWidth');
        $this->_captchaHeight       = $params->get('mod_simpleemailform_captchaHeight');
        $this->_captchaTextColor    = $params->get('mod_simpleemailform_captchaTxtColor');
        $this->_captchaLinesColor   = $params->get('mod_simpleemailform_captchaLinesColor');
        $this->_captchaBgColor      = $params->get('mod_simpleemailform_captchaBgColor');

        // Load language files
        // i.e. tr-TR.mod_simpleemailform.ini
        $this->_lang = $params->get('mod_simpleemailform_defaultLang');
        $langFile = MOD_SIMPLEEMAILFORM_DIR . DIRECTORY_SEPARATOR . 'language'
            . DIRECTORY_SEPARATOR . $this->_lang
            . DIRECTORY_SEPARATOR . $this->_lang . '.mod_simpleemailform.ini';
        if (file_exists($langFile)) {
            $this->_transLang = parse_ini_file($langFile);
        } else {
            $langFile = MOD_SIMPLEEMAILFORM_DIR . DIRECTORY_SEPARATOR . 'language'
                . DIRECTORY_SEPARATOR . $this->_lang
                . DIRECTORY_SEPARATOR . 'en-GB.mod_simpleemailform.ini';
            $this->_transLang = parse_ini_file($langFile);
        }

        // Set email object params
        $this->_msg             = new sefv2simpleemailformemailmsg();
        $this->_msg->dir        = $params->get('mod_simpleemailform_emailFile');
        $this->_msg->subject    = $params->get('mod_simpleemailform_subjectline');
        $this->_msg->copyMe     =  0;   // NOTE: depends on what user selects
        $this->_msg->fromName   = $params->get('mod_simpleemailform_fromName');
        $this->_msg->copyMeAuto = ($this->_copymeAuto == 'Y') ? 1 : 0;
        // @TODO: check for multiple targets, and, if so, convert to array()
        $to  = trim($params->get('mod_simpleemailform_emailTo'));
        $cc  = trim($params->get('mod_simpleemailform_emailCC'));
        $bcc = trim($params->get('mod_simpleemailform_emailBCC'));
        $this->_msg->to  = (preg_match('/[\s,]+/', $to))  ? preg_split('/[\s,]+/', $to)  : array($to);
        if ($cc) {
            $this->_msg->cc  = (preg_match('/[\s,]+/', $cc))  ? preg_split('/[\s,]+/', $cc)  : array($cc);
        }
        if ($bcc) {
            $this->_msg->bcc = (preg_match('/[\s,]+/', $bcc)) ? preg_split('/[\s,]+/', $bcc) : array($bcc);
        }
        // 2012-02-07 DB: add optional Reply-To field
        $this->_msg->replyToActive  = $params->get('mod_simpleemailform_replytoActive');
        if ($this->_msg->replyToActive == 'Y') {
            // 2016-04-18 DB: replyTo no longer needs to be an array
            $this->_msg->replyTo    = $params->get('mod_simpleemailform_emailReplyTo');
            if (version_compare(JVERSION, '3.0', 'ge')) {
                $this->_msg->replyTo = $params->get('mod_simpleemailform_emailReplyTo');
            } else {
                $this->_msg->replyTo = array($params->get('mod_simpleemailform_emailReplyTo'));
            }
        } else {
            $this->_msg->replyTo    = '';
        }

        // params into testInfo
        if ($this->_testMode == 'Y') {
            $this->_testInfo[] = '<br />Params: ' . var_export($params, true) . PHP_EOL;
        }

        // 2015-04-24 DB: build CSRF hash field name
        $this->_csrfField = $this->_fieldPrefix . '_oneTime_' . $this->_instance;
    }

    // Code coverage - this part of the code will be ignored since it is tested by phpt files.
    /**
     * @codeCoverageIgnoreStart
     */

    /**
     * Assumes $this->_transLang[] has been defined
     */
    public function uploadAttachment($dir, $uploadAllowed, $errorTxtColor, $successTxtColor, &$message, $fieldNum = 1)
    {
        $result  = '';
        $allowed = false;
        $fieldLabel = 'mod_simpleemailform_upload_' . $fieldNum . '_' . $this->_instance;
        // Capture the filename or else return FALSE if the filename is not set or if it is empty
        $fn = (isset($_FILES[$fieldLabel]['name']) && !empty($_FILES[$fieldLabel]['name']))
               ? basename(strip_tags($_FILES[$fieldLabel]['name'])) : false;
        // use regex to check for allowed filenames
        if ($fn) {
            // Get filename extension
            $pos = strrpos($fn, '.');       // last occurrence of '.'
            $ext = strtolower(substr($fn, $pos + 1));
            if ($uploadAllowed) {
                if (strpos($uploadAllowed, $ext)) {
                    $allowed = true;
                } else {
                    $allowed = false;
                }
            } else {
                $allowed = true;
            }
            if ($allowed) {
                // Check to see if upload parameter specified
                if ($_FILES[$fieldLabel]['error'] == UPLOAD_ERR_OK) {
                    // Check to make sure file uploaded by upload process
                    if (is_uploaded_file($_FILES[$fieldLabel]['tmp_name'])) {
                        // Set filename to current directory
                        $copyfile = $dir . DIRECTORY_SEPARATOR . $fn;
                        // Copy file
                        if (move_uploaded_file($_FILES[$fieldLabel]['tmp_name'], $copyfile)) {
                            // Save name of file
                            $message[] .= $this->formatErrorMessage($successTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_UPLOAD_SUCCESS'], $fn);
                            $result = $fn;
                            return $result;
                        } else {
                            // Trap upload file handle errors
                            $message[] .= $this->formatErrorMessage($errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_UPLOAD_UNABLE'], $fn);
                        }
                    } else {
                        // Failed security check
                        $message[] .= $this->formatErrorMessage($errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_UPLOAD_FAILURE'], $fn);
                    }
                } else {
                    // Failed security check
                    $message[] .= $this->formatErrorMessage($errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_UPLOAD_ERROR'], $fn);
                }
            } else {
                // Failed regex
                $message[] .= $this->formatErrorMessage($errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_DISALLOWED_FILENAME'], $fn);
            }
        }
        return null;
    }

    /**
     * @codeCoverageIgnoreEnd
     */

    // uses $this->_labelAlign, $this->_col2space, $this->_errorTxtColor, $this->_field, $this->_maxFields
    public function formatRow()
    {
        $output = '';
        for ($x = 1; $x <= $this->_maxFields; $x++) {
            if (stripos('-YR', $this->_field[$x]['active'])) {
                $name = $this->_fieldPrefix . $x . '_' . $this->_instance;
                $value = (isset($_POST[$name])) ? $_POST[$name] : '';
                // 2015-04-23 DB: added htmlspecialchars()
                if (is_array($value)) {
                    foreach ($value as $key => $item) {
                        $value[$key] = htmlspecialchars($item);
                    }
                } elseif (strpos($value, '@')) {
                    // prevents Joomla from reformatting using javascript
                    $value = str_replace(array('@','<','>',';'), array('&#64;','','',''), $value);
                } else {
                    $value = htmlspecialchars($value);
                }
                // 2011-12-03 DB: added CSS classes for input, table, row, th and td
                $row = '';
                $row .= '<tr class="' . $this->_trClass   . '">';
                // labels
                $row .= sprintf(
                    "<th align='%s' style='text-align:%s;' class='%s'>%s</th>",
                    $this->_labelAlign,
                    $this->_labelAlign,
                    $this->_thClass,
                    $this->_field[$x]['label']
                );
                // space between cols
                $row .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space  . "'>&nbsp;</td>";
                // input field
                $row .= "<td class='" . $this->_tdClass    . "'>";
                // check field type
                switch ($this->_field[$x]['from']) {
                    case 'A':
                        // if rows and cols values not set, establish defaults
                        $inputClass = $this->_inputClass . '_textarea';
                        list($numRows, $numCols) = explode(',', $this->_field[$x]['size']);
                        $numRows = ($numRows) ? $numRows : 4;
                        $numCols = ($numCols) ? $numCols : 40;
                        $row .= sprintf(
                            '<textarea name="%s" id="%s" rows="%d" cols="%d" class="%s" placeholder="%s">%s</textarea>',
                            $name,
                            $name,
                            $numRows,
                            $numCols,
                            $inputClass,
                            $this->_field[$x]['value'],
                            $value
                        );
                        break;
                    case 'D':
                        // drop down select list
                        $inputClass = $this->_inputClass . '_select';
                        $row .= sprintf('<select name="%s" id="%s" class="%s">' . PHP_EOL, $name, $name, $inputClass);
                        foreach ($this->_field[$x]['value'] as $key => $visible) {
                            $key     = htmlspecialchars($key);
                            $visible = htmlspecialchars($visible);
                            $row .= "<option value=\"$key\">$visible</option>\n";
                        }
                        $row .= "</select>\n";
                        break;
                    case 'R':
                        // radio button list
                        $value = (is_array($value)) ? $value : array();
                        $row .= $this->buildCheckRadioField($this->_field[$x], $name, 'radio', $value);
                        break;
                    case 'C':
                        // checkbox list
                        $value = (is_array($value)) ? $value : array();
                        $row .= $this->buildCheckRadioField($this->_field[$x], $name, 'checkbox', $value);
                        break;
                    case 'F':
                        // 2013-11-07 DB: added HTML5 email type field if email checking is enabled
                        // from field
                        $type = ($this->_emailCheck) ? 'email' : 'text';
                        $row .= sprintf(
                            '<input type="%s" name="%s" id="%s" size="%d" value="%s" maxlength="%d" class="%s"/>',
                            $type,
                            $name,
                            $name,
                            $this->_field[$x]['size'],
                            $value,
                            $this->_field[$x]['maxx'],
                            $this->_inputClass
                        );
                        break;
                    // 2014-05-21 DB: added User Defined field ... for customization
                    case 'U':
                        // 2014-05-21 DB: in this example we have an HTML5 "phone" field, which accepts only phone numbers
                        $row .= sprintf(
                            '<input type="phone" name="%s" id="%s" size="%d" value="%s" maxlength="%d" class="%s" placeholder="%s"/>',
                            $name,
                            $name,
                            $this->_field[$x]['size'],
                            $value,
                            $this->_field[$x]['maxx'],
                            $this->_inputClass,
                            // 2015-04-23 DB: added htmlspecialchars()
                                        htmlspecialchars($this->_field[$x]['value'])
                        );
                        // Fall-through is intentional
                    default:
                        $row .= sprintf(
                            '<input type="text" name="%s" id="%s" size="%d" value="%s" maxlength="%d" class="%s" placeholder="%s"/>',
                            $name,
                            $name,
                            $this->_field[$x]['size'],
                            $value,
                            $this->_field[$x]['maxx'],
                            $this->_inputClass,
                            // 2015-04-23 DB: added htmlspecialchars()
                                        htmlspecialchars($this->_field[$x]['value'])
                        );
                }
                $row .= ($this->_field[$x]['error'])
                      ? $this->formatErrorMessage($this->_errorTxtColor, $this->_field[$x]['error'])
                      : '';
                $row .= "</td>";
                $row .= "</tr>\n";
                $output .= $row;
            }
        }
        return $output;
    }

    // uses $this->_inputClass and $this->_(tr|th|td|table)Class to build CSS class
    protected function buildCheckRadioField($field, $name, $type, $value)
    {
        $output     = '';
        $width      = '';
        $inputClass = $this->_inputClass . '_' . $type;
        $tblClass   = $this->_tableClass . '_' . $type;
        $trClass    = $this->_trClass    . '_' . $type;
        $thClass    = $this->_thClass    . '_' . $type;
        $tdClass    = $this->_tdClass    . '_' . $type;
        $cssLabel   = $this->_cssClass   . '_' . $type . '_label';
        $cssInput   = $this->_cssClass   . '_' . $type . '_input';
        if ($field['size']) {
            $width = 'style="width:' . $field['size'] . 'px;"';
        }
        $format = $field['ckRfmt'] . $field['ckRpos'];
        switch ($format) {
            case 'HB':         // horizontal, label before
                $output .= "<table class='" . $tblClass . "'><tr class='" . $trClass . "'>\n";
                foreach ($field['value'] as $key => $visible) {
                    $checked = (in_array($key, $value, true)) ? 'checked' : '';
                    $list = array($thClass, $width, $this->padVisible($visible), $tdClass, $type, $name, $name, $key, $key, $inputClass, $checked);
                    $output .= vsprintf('<th class="%s" %s>%s</th><td class="%s"><input type="%s" name="%s[]" id="%s_%s" value="%s" class="%s" %s/></td>', $list);
                }
                $output .= "</tr></table>\n";
                break;
            case 'HA':         // horizontal, label after
                $output .= "<table class='" . $tblClass . "'><tr class='" . $trClass . "'>\n";
                foreach ($field['value'] as $key => $visible) {
                    $checked = (in_array($key, $value, true)) ? 'checked' : '';
                    $list = array($tdClass, $type, $name, $name, $key, $key, $inputClass, $checked, $thClass, $width, $this->padVisible($visible));
                    $output .= vsprintf('<td class="%s"><input type="%s" name="%s[]" id="%s_%s" value="%s" class="%s" %s/></td><th class="%s" %s>%s</th>', $list);
                }
                $output .= "</tr></table>\n";
                break;
            case 'VB':         // vertical, label before
                $output .= "<table class='" . $tblClass . "'>\n";
                foreach ($field['value'] as $key => $visible) {
                    $checked = (in_array($key, $value, true)) ? 'checked' : '';
                    $list = array($trClass, $thClass, $width, $this->padVisible($visible), $tdClass, $type, $name, $name, $key, $key, $inputClass, $checked);
                    $output .= vsprintf('<tr class="%s"><th class="%s" %s>%s</th><td class="%s"><input type="%s" name="%s[]" id="%s_%s" value="%s" class="%s" %s/></td></tr>' . PHP_EOL, $list);
                }
                $output .= "</table>\n";
                break;
            case 'VA':         // vertical, label after
                $output .= "<table class='" . $tblClass . "'>\n";
                foreach ($field['value'] as $key => $visible) {
                    $checked = (in_array($key, $value, true)) ? 'checked' : '';
                    $list = array($trClass, $tdClass, $type, $name, $name, $key, $key, $inputClass, $checked, $thClass, $width, $this->padVisible($visible));
                    $output .= vsprintf('<tr class="%s"><td class="%s"><input type="%s" name="%s[]" id="%s_%s" value="%s" class="%s" %s/></td><th class="%s" %s>%s</th></tr>' . PHP_EOL, $list);
                }
                $output .= "</table>\n";
                break;
            case 'CB':         // use CSS label before
                $output .= '<span class="' . $cssLabel . '">';
                foreach ($field['value'] as $key => $visible) {
                    $checked = (in_array($key, $value, true)) ? 'checked' : '';
                    $list = array($this->padVisible($visible), $type, $name, $name, $key, $key, $cssInput, $checked);
                    $output .= vsprintf('%s<input type="%s" name="%s[]" id="%s_%s" value="%s" class="%s" %s/>', $list);
                }
                $output .= '</span>' . PHP_EOL;
                break;
            case 'CA':         // use CSS label after
                $output .= '<span class="' . $cssLabel . '">';
                foreach ($field['value'] as $key => $visible) {
                    $checked = (in_array($key, $value, true)) ? 'checked' : '';
                    $list = array($type, $name, $name, $key, $key, $cssInput, $checked, $this->padVisible($visible));
                    $output .= vsprintf('<input type="%s" name="%s[]" id="%s_%s" value="%s" class="%s" %s/>%s', $list);
                }
                $output .= '</span>' . PHP_EOL;
                break;
            default:       // nothing defined
                $output .= "<table>";
                $output .= "<tr><td>Undefined</td></tr>\n";
                $output .= "</table>\n";
        }
        return $output;
    }

    protected function padVisible($visible)
    {
        return '&nbsp;&nbsp;' . $visible . '&nbsp;&nbsp;';
    }

    public function sendResults(sefv2simpleemailformemailmsg &$msg, $field)
    {
        // 2012-02-15 db: override unwanted error messages originating from JMail
        ob_start();
        // Build Body
        $msg->body =  '';
        // 2013-09-01 db: added article title
        if ($this->_addTitle) {
            try {
                $document = JFactory::getDocument();
                $msg->body .= "\nArticle Title: " . $document->getTitle();
            } catch (Exception $e) {
                echo $this->_transLang['MOD_SIMPLEEMAILFORM_ERROR'] . ': JFactory::getDocument()->getTitle()';
            }
        }
        for ($x = 1; $x <= $this->_maxFields; $x++) {
            $label = $this->_fieldPrefix . $x . '_' . $this->_instance;
            // if "active" = hidden, pull in value automatically
            if ($field[$x]['active'] == 'H') {
                $msg->body .= "\n" . $field[$x]['label'] . ': ' . $field[$x]['value'];
            // otherwise pull value from $_POST
            } else {
                // 2013-04-20 DB: added check for array -- to account for checkboxes / multi-select
                $value = '';
                if (isset($_POST[$label])) {
                    if (is_array($_POST[$label])) {
                        $value = implode(" / ", $_POST[$label]);
                    } else {
                        $value = $_POST[$label];
                    }
                }
                $msg->body .= ($value) ? "\n" . $field[$x]['label'] . ': ' . htmlspecialchars($value) : '';
            }
        }
        // Strip slashes
        $msg->body = stripslashes($msg->body);
        // Filter for \n in subject - 2010-05-03 DB
        $msg->subject = str_replace("\n", '', $msg->subject);
        // Send mail
        $message = JFactory::getMailer();
        //echo $message->dumpLanguage(); exit;
        $message->addRecipient($msg->to);
        $message->setSender($msg->from);
        $message->setSubject($msg->subject);
        $message->setBody($msg->body);
        // 2012-02-03 DB: added reply to field (has to be array())
        if ($msg->cc) {
            $message->addCC($msg->cc);
        }
        if ($msg->bcc) {
            $message->addBCC($msg->bcc);
        }
        if ($msg->replyTo) {
            $message->addReplyTo($msg->replyTo);
        }
        // 2012-02-15 DB: set up attachments as an array
        if (count($msg->attachment) > 0) {
            // Formulate FN for attachment
            foreach ($msg->attachment as $fn) {
                /* Check if null was returned by uploadAttachment()
				 * due to empty upload fields
				 */
                if (isset($fn)) {
                    $fullPath = $msg->dir . DIRECTORY_SEPARATOR . $fn;
                    $message->addAttachment($fullPath);
                }
            }
        }
        try {
            if (!$sent = $message->send()) {
                throw new Exception($this->_transLang['MOD_SIMPLEEMAILFORM_ERROR']);
            }
            $msg->copyMe = (isset($_POST['mod_simpleemailform_copyMe_' . $this->_instance]))
                            ? (int) $_POST['mod_simpleemailform_copyMe_' . $this->_instance] : 0;
            // 2011-08-12 DB: added option for copyMeAuto
            if ($msg->copyMe || $msg->copyMeAuto) {
                $message->clearAllRecipients();
                $message->addRecipient($msg->from, $msg->fromName);
                if (!$sent = $message->send()) {
                    throw new Exception($this->_transLang['MOD_SIMPLEEMAILFORM_ERROR']);
                }
            }
            $result = true;
        } catch (Exception $e) {
            $result = false;
            $msg->error = $this->_transLang['MOD_SIMPLEEMAILFORM_ERROR'] . ': Mail Server';
            $msg->error .= '<br />' . $this->_transLang['MOD_SIMPLEEMAILFORM_EMAIL_INVALID'];
            if ($this->_testMode == 'Y') {
                $this->_testInfo[] = '<br />' . $e->getMessage() . "\n";
                $this->_testInfo[] = '<br />' . $e->getTraceAsString() . "\n";
            }
        }
        // 2012-02-15 db: override unwanted error messages originating from JMail
        // 2012-03-07 DB: added test mode
        if ($this->_testMode == 'Y') {
            $this->_testInfo[] = '<br />' . ob_get_contents() . "\n";
            $this->_testInfo[] .= 'Mail Object:' . '<br />';
            $this->_testInfo[] .= '<pre>';
            $this->_testInfo[] .= var_export($this->_msg, true);
            $this->_testInfo[] .= '</pre>';
        }
        ob_end_clean();
        return $result;
    }

    public function imageCaptcha(
        $captchaBgColor,
        $captchaDir,
        $captchaHeight,
        $captchaLen,
        $captchaLinesColor,
        $captchaSize,
        $captchaTextColor,
        $captchaURL,
        $captchaWidth,
        &$url_fn
    ) {

        require_once MOD_SIMPLEEMAILFORM_DIR . DIRECTORY_SEPARATOR . 'sef' . DIRECTORY_SEPARATOR . 'Image.php';
        $imgOptions = array(
            'font_size'         => $captchaSize,
            'font_path'         => dirname(__FILE__),
            'font_file'         => 'FreeSansBold.ttf',
            'text_color'        => $captchaTextColor,
            'lines_color'       => $captchaLinesColor,
            'background_color'  => $captchaBgColor
        );
        $options = array(
            'width'         => $captchaWidth,
            'height'        => $captchaHeight,
            'output'        => 'png',
            'imageOptions'  => $imgOptions,
        );
        // Set CAPTCHA phrase length
        Text_CAPTCHA_Driver_Image::$_phraseLength = $this->_captchaLen;
        // Generate a new Text_CAPTCHA object, Image driver
        $c = Text_CAPTCHA::factory('Image');
        $retval = $c->init($options);
        if (PEAR::isError($retval)) {
            throw new Exception($this->_transLang['MOD_SIMPLEEMAILFORM_CAPTCHA_ERROR_INIT'] . ' ' . $retval->getMessage());
        }

        // Get CAPTCHA image (as PNG)
        $png = $c->getCAPTCHAAsPNG();
        if (PEAR::isError($png)) {
            throw new Exception($this->_transLang['MOD_SIMPLEEMAILFORM_CAPTCHA_ERROR_GEN'] . ' ' . $png->getMessage());
        }
        $randval = time() . rand(1, 999);
        $fn = 'captcha_' . $this->_instance . '_' . md5($randval) . '.png';
        $put_fn = $captchaDir . DIRECTORY_SEPARATOR . $fn;
        // 2013-10-24 DB: added check for trailing '/'
        if (substr($captchaURL, -1, 1) === '/') {
            $url_fn = $captchaURL . $fn;
        } else {
            // 2013-10-24 DB: hard-coded the "/" into the URL
            $url_fn = $captchaURL . '/' . $fn;
        }
        JFile::write($put_fn, $png);

        return $c->getPhrase();
    }

    // @todo Add styling - the textCaptcha only returns the phrase without styling
    // @todo Implement font size
    // @todo Implement captcha width
    public function textCaptcha(
        $captchaBgColor,
        $captchaLen,
        $captchaSize,
        $captchaTextColor,
        $captchaWidth,
        &$textCaptcha
    ) {

            $alpha = 'abcdefghijklmnopqrstuvwxyz';
            $textCaptcha = "<span style='color: $captchaTextColor; background-color: $captchaBgColor;'>";
            $phrase = '';
            $count = 0;
        for ($x = 0; $x < $captchaLen; $x++) {
            $a = substr($alpha, rand(0, 25), 1);
            $phrase .= $a;
            switch ($count) {
                case ($count % 1):
                    $textCaptcha .= "<b>$a</b>";
                    break;
                default:
                    $textCaptcha .= "<font size=+2>$a</font>";
                    break;
            }
            $count++;
        }
            $textCaptcha .= '</span>';
            return $phrase;
    }

    protected function formatErrorMessage($color, $message, $fn = '')
    {
        if ($fn) {
            $message = "<p><b><span style='color:$color;'>$message ($fn)</span></b></p>\n";
        } else {
            $message = "<p><b><span style='color:$color;'>$message</span></b></p>\n";
        }
        return $message;
    }

    protected function autoResetForm()
    {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = '';
        }
    }

    /**
     * Verifies that the string is in a proper email address format.
     * @param   string  $email  String to be verified.
     * @return  boolean  True if string has the correct format; false otherwise.
     * @since   11.1
     */
    public static function isEmailAddress($email)
    {
        // Split the email into a local and domain
        $atIndex = strrpos($email, "@");
        $domain = substr($email, $atIndex + 1);
        $local = substr($email, 0, $atIndex);

        // Check Length of domain
        $domainLen = strlen($domain);
        if ($domainLen < 1 || $domainLen > 255) {
            return false;
        }

        // Check Length of local
        $localLen = strlen($local);
        if ($localLen < 1 || $localLen > 64) {
            return false;
        }

        /*
         * Check the local address
         * We're a bit more conservative about what constitutes a "legal" address, that is, A-Za-z0-9!#$%&\'*+/=?^_`{|}~-
         * Also, the last character in local cannot be a period ('.')
         */
        $allowed = 'A-Za-z0-9!#&*+=?_-';
        $regex = "/^[$allowed][\.$allowed]{0,63}$/";
        if (!preg_match($regex, $local) || substr($local, -1) == '.') {
            return false;
        }

        // No problem if the domain looks like an IP address, ish
        $regex = '/^[0-9\.]+$/';
        if (preg_match($regex, $domain)) {
            return true;
        }

        // Check the domain
        $domain_array = explode(".", rtrim($domain, '.'));
        $regex = '/^[A-Za-z0-9-]{0,63}$/';
        foreach ($domain_array as $domain) {
            // Must be something
            if (!$domain) {
                return false;
            }

            // Check for invalid characters
            if (!preg_match($regex, $domain)) {
                return false;
            }

            // Check for a dash at the beginning of the domain
            if (strpos($domain, '-') === 0) {
                return false;
            }

            // Check for a dash at the end of the domain
            $length = strlen($domain) - 1;
            if (strpos($domain, '-', $length) === $length) {
                return false;
            }
        }

        return true;
    }

    // Retrieve CAPTCHA hash components
    protected function buildCaptchaHashComponents()
    {
        return str_replace('.', '', $_SERVER['REMOTE_ADDR'] . date('YmdH') . session_id());
    }

    // Build CAPTCHA hash
    protected function buildCaptchaHash($phrase, &$testHash = null)
    {
        return md5($phrase . md5($this->buildCaptchaHashComponents()));
    }

    // Build CAPTCHA fields
    protected function buildUserCaptchaField()
    {
        return 'mod_simpleemailform_captcha_' . $this->_instance;
    }
    protected function buildHiddenCaptchaField()
    {
        return 'mod_simpleemailform_crsf_' . $this->_instance;
    }

    // CAPTCHA match
    protected function doesCaptchaMatch()
    {
        $match = false;
        $userCaptchaField   = $this->buildUserCaptchaField();
        $hiddenCaptchaField = $this->buildHiddenCaptchaField();
        if (isset($_POST[$userCaptchaField]) && isset($_POST[$hiddenCaptchaField])) {
            $hiddenHash         = $_POST[$hiddenCaptchaField];
            $userHash       = $this->buildCaptchaHash($_POST[$userCaptchaField]);
            $match          = ($userHash == $hiddenHash);
        }
        return $match;
    }

    // render CAPTCHA
    protected function renderCaptcha()
    {
        // Set CAPTCHA secret passphrase
        if ($this->_useCaptcha == 'I') {
            $phrase = $this->imageCaptcha(
                $this->_captchaBgColor,
                $this->_captchaDir,
                $this->_captchaHeight,
                $this->_captchaLen,
                $this->_captchaLinesColor,
                $this->_captchaSize,
                $this->_captchaTextColor,
                $this->_captchaURL,
                $this->_captchaWidth,
                $this->_url_fn
            );
        } else {
            $phrase = $this->textCaptcha(
                $this->_captchaBgColor,
                $this->_captchaLen,
                $this->_captchaSize,
                $this->_captchaTextColor,
                $this->_captchaWidth,
                $this->_textCaptcha
            );
        }

        $hiddenHash = $this->buildCaptchaHash($phrase);

        $output = '';
        $output .= "<tr class='" . $this->_trClass . "'>";
        $output .= sprintf(
            "<th align='%s' style='text-align:%s;' class='%s'>%s</th>",
            $this->_labelAlign,
            $this->_labelAlign,
            $this->_thClass,
            $this->_transLang['MOD_SIMPLEEMAILFORM_CAPTCHA_PLEASE_ENTER']
        );
        // space between cols
        $output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
        // captcha
        $output .= "<td class='" . $this->_tdClass . "'>";
        if ($this->_useCaptcha == 'I') {
            $output .= vsprintf(
                "<img src='%s' width='%s' height='%s' %s />",
                array($this->_url_fn, $this->_captchaWidth,$this->_captchaHeight, $this->_captchaClass)
            );
            $output .= "<br />";
        } else {
            $output .= $this->_textCaptcha;
        }
        $output .= "<input name='" . $this->buildUserCaptchaField() . "' "
                        . "id='" . $this->buildUserCaptchaField() . "' "
                        . "type='text' "
                        . "size='" . $this->_captchaLen . "' "
                        . "maxlength='" . $this->_captchaLen . "' "
                        . " class='" . $this->_inputClass . "' />";
        $output .= "&nbsp;" . $this->_transLang['MOD_SIMPLEEMAILFORM_CAPTCHA_PLEASE_HELP'];
        // send md5 hash of CAPTCHA phrase
        $output .= "<input type='hidden' name='" . $this->buildHiddenCaptchaField() . "' value='" . $hiddenHash . "' />\n";
        $output .= "</td>";
        $output .= "</tr>\n";
        return $output;
    }

    // Cleanup old CAPTCHA images
    protected function cleanupCaptchas()
    {
        $output = '';
        try {
            // Get rid of old CAPTCHA images older than 5 minutes
            $timeCheck = time() - (60 * 5);     // subtracts 5 minutes
            foreach (new DirectoryIterator($this->_captchaDir) as $file) {
                if (!$file->isDot()) {
                    $fn = $file->getFilename();
                    if (strlen($fn) > 8 && strpos($fn, 'captcha_') === 0) {
                        $fn = $this->_captchaDir . DIRECTORY_SEPARATOR . $fn;
                        // remove CAPTCHAs older than 5 minutes
                        if ($file->getMTime() < $timeCheck) {
                            unlink($fn);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $output .= $this->formatErrorMessage($this->_errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_UNABLE_CLEAN_CAPTCHA']);
            // Make Captcha directory and URL recommendations
            $dirs = explode(DIRECTORY_SEPARATOR, dirname(__FILE__));
            if (count($dirs) > 2) {
                array_pop($dirs);
                array_pop($dirs);
            }
            $suggestedCaptchaDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'captcha';
            $suggestedCaptchaURL = 'http://' . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . 'captcha';
            $output .= "<p>" . $this->_transLang['MOD_SIMPLEEMAILFORM_MAKE_CAPTCHA_DIR'] . ": " . $suggestedCaptchaDir . "</p>\n";
            $output .= "<p>" . $this->_transLang['MOD_SIMPLEEMAILFORM_MAKE_CAPTCHA_URL'] . ": " . $suggestedCaptchaURL . "</p>\n";
            if ($this->_testMode == 'Y') {
                $this->_testInfo[] = "<p>" . __FILE__               . "</p>\n";
                $this->_testInfo[] = "<p>" . $e->getTraceAsString()     . "</p>\n";
            }
        }
        return $output;
    }

    // Render file upload field
    protected function buildFileUploadField($fieldNum = 1)
    {
        $inputClass = $this->_inputClass . '_upload';
        return "<br />"
                . "<input "
                . "type=file "
                . "name='mod_simpleemailform_upload_" . $fieldNum . '_' . $this->_instance . "' "
                . "id='mod_simpleemailform_upload_" . $fieldNum . '_' . $this->_instance . "' "
                . "enctype='multipart/form-data' "
                . "class='" . $inputClass . "'"
                . " />";
    }

    // 2015-04-23 DB: builds 1 time hash + stores in $_SESSION
    protected function buildCsrfHash()
    {
        $server = (isset($_SERVER['REMOTE_ADDR']))     ? $_SERVER['REMOTE_ADDR']     : microtime();
        $uagent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : microtime();
        $hash = md5($server . microtime()) . sha1($uagent . microtime());
        $_SESSION[$this->_csrfField] = $hash;
        return $hash;
    }

    // 2015-04-23 DB: accepts hash from form and compares to session
    protected function compareCsrfHash()
    {
        $hashFromForm = (isset($_POST[$this->_csrfField])) ? $_POST[$this->_csrfField] : 'NoForm';
        $hashFromSess = (isset($_SESSION[$this->_csrfField])) ? $_SESSION[$this->_csrfField] : 'NoSess';
        $_SESSION[$this->_csrfField] = sha1(date('Y-m-d-H-i-s') . rand(0, 999999));
        return ($hashFromSess == $hashFromForm);
    }

    // Main logic
    public function main()
    {
        // initialize vars + test mode
        if ($this->_testMode == 'Y') {
            error_reporting(E_ALL | E_STRICT);
            ini_set('display_errors', 1);
        }
        $message = '';

        if (isset($this->_useCaptcha) && $this->_useCaptcha == "I") {
            $this->_output .= $this->cleanupCaptchas();
        }

        // 2015-04-24 DB: test CSRF hash & see if submit button pressed
        if (isset($_POST['mod_simpleemailform_submit_' . $this->_instance]) && $this->compareCsrfHash()) {
            // Check to see if "from" email address has been posted
            $fieldLabel = $this->_fieldPrefix . $this->_fromField . '_' . $this->_instance;
            if (isset($_POST[$fieldLabel]) && $this->_field[$this->_fromField]['active'] != 'H') {
                $this->_msg->from = strip_tags($_POST[$fieldLabel]);
            } else {
                // Set default "from" field value
                $this->_msg->from = $this->_field[$this->_fromField]['value'];
            }
            // Check subject
            $fieldLabel = $this->_fieldPrefix . $this->_subjectField . '_' . $this->_instance;
            if (isset($_POST[$fieldLabel]) && $this->_field[$this->_subjectField]['active'] != 'H') {
                $this->_msg->subject = strip_tags($_POST[$fieldLabel]);
            } else {
                $this->_msg->subject = $this->_field[$this->_subjectField]['value'];
            }

            // Check to see if "from" email address contains "&#64;"
            $this->_msg->from = (isset($this->_msg->from)) ? str_ireplace('&#64;', '@', $this->_msg->from) : '';

            // validate email only if "Email Check" is set to "yes"
            $requiredCheck = true;
            if ($this->_emailCheck) {
                $email_ok = isset($this->_msg->from) && $this->_msg->from && $this->isEmailAddress($this->_msg->from);
                if (!$email_ok) {
                    $requiredCheck = false;
                    $this->_field[$this->_fromField]['error'] = $this->_transLang['MOD_SIMPLEEMAILFORM_EMAIL_INVALID']
                                                              . ' '
                                                              . $this->_field[$this->_fromField]['label'];
                }
            }
            // Check required fields
            for ($x = 1; $x <= $this->_maxFields; $x++) {
                $fieldLabel = $this->_fieldPrefix . $x . '_' . $this->_instance;
                if ($this->_field[$x]['active'] == 'R') {
                    if (!isset($_POST[$fieldLabel]) || $_POST[$fieldLabel] == null) {
                        $requiredCheck = false;
                        $this->_field[$x]['error'] = $this->_transLang['MOD_SIMPLEEMAILFORM_REQUIRED_FIELD'] . ' ' . $this->_field[$x]['label'];
                    }
                }
            }
            // proceed only if required fields all check out
            if ($requiredCheck) {
                $sendResultsFlag = true;
                // Validate captcha if active
                if ($this->_useCaptcha != 'N') {
                    // test mode
                    if ($this->_testMode == 'Y') {
                        $this->_testInfo[] = '<br />CAPTCHA components: ' . $this->buildCaptchaHashComponents() . PHP_EOL;
                    }
                    // does form CAPTCHA fields hash match full hash?
                    if (!$this->doesCaptchaMatch()) {
                        $sendResultsFlag = false;
                        $message .=  $this->formatErrorMessage($this->_errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_FORM_REENTER']);
                    }
                }
                // send results if OK
                if ($sendResultsFlag) {
                    // upload attachment (if active) and add to msg object
                    if ($this->_uploadActive) {
                        // 2013-02-15 DB: added ability to have > 1 upload field
                        for ($x = 1; $x <= $this->_uploadActive; $x++) {
                            $this->_msg->attachment[] = $this->uploadAttachment(
                                $this->_msg->dir,
                                $this->_uploadAllowed,
                                $this->_errorTxtColor,
                                $this->_successTxtColor,
                                $this->_fileMsg,
                                $x  // file upload field #
                            );
                        }
                    }

                    if ($this->sendResults($this->_msg, $this->_field)) {
                        $message .=  $this->formatErrorMessage($this->_successTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_FORM_SUCCESS']);
                        if ($this->_redirectURL !== '') {
                            header('Location: ' . $this->_redirectURL);
                            exit;
                        }
                        if ($this->_autoReset) {
                            $this->autoResetForm();
                        }
                    } else {
                        $message .=  $this->formatErrorMessage($this->_errorTxtColor, $this->_transLang['MOD_SIMPLEEMAILFORM_FORM_UNABLE']);
                    }
                }
                // Add any mail server error messages (is blank if none)
                $message .= $this->_msg->error;
            }
        // actions if submit button has not been clicked
        } else {
            // reset form
            if (isset($_POST['mod_simpleemailform_reset_' . $this->_instance])) {
                $this->autoResetForm();
            }
            // Check "from" email address & subject
            for ($x = 1; $x <= $this->_maxFields; $x++) {
                if ($this->_field[$x]['from'] == 'F') {
                    $this->_msg->from = $this->_field[$x]['value'];
                } elseif ($this->_field[$x]['from'] == 'S') {
                    $this->_msg->subject = $this->_field[$x]['value'];
                }
            }
        }

        // Present the Email Form
        $this->_output .= ($this->_cssClass) ? "<div class='" . $this->_cssClass . "'>\n" : '';
        // 2012-04-20 DB: added anchor tag if > 1 (default anchor = #)
        $this->_output .= (strlen($this->_anchor) > 1) ? "<a name='" . substr($this->_anchor, 1) . "'>&nbsp;</a>\n" : '';
        $this->_output .= "<form method='post' "
                        . "action='" . $this->_anchor . "' "
                        . "name='mod_simpleemailform_" . $this->_instance . "' "
                        . "id='mod_simpleemailform_" . $this->_instance . "' "
                        . "enctype='multipart/form-data'>\n";
        $this->_output .= "<table class='" . $this->_tableClass . "'>\n";
        // 2010-11-28 DB: all fields are now included in $this->_field[]
        $this->_output .= $this->formatRow();

        // check for file uploads
        if ($this->_uploadActive) {
            $this->_output .= "<tr class='" . $this->_trClass . "'>";
            $this->_output .= sprintf(
                "<th align='%s' style='text-align:%s;' class='%s'>%s</th>",
                $this->_labelAlign,
                $this->_labelAlign,
                $this->_thClass,
                $this->_uploadLabel
            );
            // space between cols
            $this->_output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
            // file upload field
            $this->_output .= "<td class='" . $this->_tdClass . "'>";
            // 2013-02-15 DB: added ability to have > 1 upload field
            for ($x = 1; $x <= $this->_uploadActive; $x++) {
                $this->_output .= $this->buildFileUploadField($x);
                if (!empty($this->_fileMsg[($x-1)])) {
                    $this->_output .= $this->_fileMsg[$x-1];
                }
            }
            $this->_output .= "</td>";
            $this->_output .= "</tr>\n";
        }

        // render CAPTCHA
        if ($this->_useCaptcha != 'N') {
            try {
                // render CAPTCHA
                $this->_output .= $this->renderCaptcha();
            } catch (Exception $e) {
                $this->_output .= "<tr class='" . $this->_trClass . "'>";
                $this->_output .= sprintf(
                    "<th align='%s'  style='text-align:%s;'  class='%s'>%s</th>",
                    $this->_labelAlign,
                    $this->_labelAlign,
                    $this->_thClass,
                    $this->_transLang['MOD_SIMPLEEMAILFORM_ERROR']
                );
                // space between cols
                $this->_output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
                // message
                $this->_output .= "<td class='" . $this->_tdClass . "'>" . $e->getMessage() . "</td>";
                $this->_output .= "</tr>\n";
            }
        }

        // copy me field
        if ($this->_copymeActive == 'Y') {
            $this->_output .= "<tr class='" . $this->_trClass . "'>";
            $this->_output .= "<th class='" . $this->_thClass . "'>&nbsp;</th>";
            // space between cols
            $this->_output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
            // copy me
            $this->_output .= "<td class='" . $this->_tdClass . "'>";
            $this->_output .= "<input "
                            . "type='checkbox' "
                            . "name='mod_simpleemailform_copyMe_" . $this->_instance . "' "
                            . "id='mod_simpleemailform_copyMe_" . $this->_instance . "' "
                            . "value='1' "
                            . " class='" . $this->_inputClass . "' />"
                            . $this->_copymeLabel
                            . "</td>";
            $this->_output .= "</tr>\n";
        }

        // buttons
        $this->_output .= "<tr class='" . $this->_trClass . "'>";
        $this->_output .= "<th class='" . $this->_thClass . "'>&nbsp;</th>";
        $this->_output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
        $this->_output .= "<td class='" . $this->_tdClass . "'>";
        $this->_output .= "<input "
                        . " class='" . $this->_inputClass . "' "
                        . "type='submit' "
                        . "name='mod_simpleemailform_submit_" . $this->_instance . "' "
                        . "id='mod_simpleemailform_submit_" . $this->_instance . "' "
                        . "value='" . $this->_transLang['MOD_SIMPLEEMAILFORM_BUTTON_SUBMIT'] . "' "
                        . "title='" . $this->_transLang['MOD_SIMPLEEMAILFORM_CLICK_SUBMIT'] . "' />";
        $this->_output .= "&nbsp;&nbsp;";
        $this->_output .= "<input "
                        . " class='" . $this->_inputClass . "' "
                        . "type='submit' "
                        . "name='mod_simpleemailform_reset_" . $this->_instance . "' "
                        . "id='mod_simpleemailform_reset_" . $this->_instance . "' "
                        . "value='" . $this->_transLang['MOD_SIMPLEEMAILFORM_BUTTON_RESET'] . "' "
                        . "title='' />";
        $this->_output .= "</td>";
        $this->_output .= "</tr>\n";

        // message
        if ($message) {
            $this->_output .= "<tr class='" . $this->_trClass . "'>";
            $this->_output .= "<th class='" . $this->_thClass . "'>&nbsp;</th>";
            // space between cols
            $this->_output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
            // message
            $this->_output .= "<td class='" . $this->_tdClass . "'>";
            $this->_output .= $message;
            $this->_output .= "</td>";
            $this->_output .= "</tr>\n";
        }

        // test mode
        if ($this->_testMode == 'Y') {
            $this->_output .= "<tr class='" . $this->_trClass . "'>";
            $this->_output .= "<th class='" . $this->_thClass . "'>&nbsp;</th>";
            // space between cols
            $this->_output .= "<td class='" . $this->_spaceClass . "' width='" . $this->_col2space . "'>&nbsp;</td>";
            // message
            $this->_output .= "<td class='" . $this->_tdClass . "'>";
            $this->_output .= '<pre>';
            $this->_output .= '$_POST:' . '<br />';
            $this->_output .= htmlspecialchars(var_export($_POST, true));
            $this->_output .= "\nTest Info:" . '<br />';
            foreach ($this->_testInfo as $item) {
                $this->_output .= $item;
            }
            $this->_output .= "\nMail Object:" . '<br />';
            $this->_output .= var_export($this->_msg, true);
            $this->_output .= "\nMisc Vars:" . '<br />';
            $this->_output .= '_fromField: ' . $this->_fromField;
            $this->_output .= '</pre>';
            $this->_output .= "</td>";
            $this->_output .= "</tr>\n";
        }
        $this->_output .= "</table>\n";
        // 2015-04-24 DB: add CSRF hash
        $this->_output .= sprintf(
            "<input type='hidden' name='%s' value='%s'>\n",
            $this->_csrfField,
            $this->buildCsrfHash()
        );
        $this->_output .= "</form>\n";
        $this->_output .= ($this->_cssClass) ? '</div>' : '';
        return $this->_output;
    }

    public function render()
    {
        return $this->main();
    }

    /*
     * 2017-12-21 AC: Added this placeholder method to avoid a backward-compatibility break
     * caused by the new customrenderinginterface implementation.
     */
    public function getFormRendering()
    {
        return true;
    }
}
