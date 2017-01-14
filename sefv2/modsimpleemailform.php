<?php

use \Joomla\Registry\Registry;

class sefv2modsimpleemailform implements
    sefv2jformproxyinterface,
    sefv2formrendererinterface
{

    /**
     * @var JForm
     * @since 2.0.0
     */
    protected $jForm;

    /**
     * @var JMail
     * @since 2.0.0
     */
    protected $jMail;

    /**
     * @var sefv2simpleemailformemailmsg
     * @since 2.0.0
     */
    protected $emailMsg;

    /**
     * @var JDocument
     * @since 2.0.0
     */
    protected $jDocument;

    /**
     * @var JLanguage
     * @since 2.0.0
     */
    protected $jLanguage;

    /**
     * @var Registry
     * @since 2.0.0
     */
    protected $params;

    /**
     * @var JInput
     * @since 2.0.0
     */
    protected $jInput;

    /**
     * @var JTableExtension
     * @since 2.0.0
     */
    protected $jTableExtension;

    /**
     * @var JTableModule
     * @since 2.0.0
     */
    protected $jTableModule;

    /**
     * @var stdClass
     * @since 2.0.0
     */
    protected $jModuleHelperResult;

    /**
     * @var JSession
     * @since 2.0.0
     */
    protected $jSession;

    /**
     * @var JFile
     * @since 2.0.0
     */
    protected $jFile;

    /**
     * @var array (int)
     * @since 2.0.0
     */
    protected $jComponentIds;

    /**
     * @var stdClass
     * @since 2.0.0
     */
    protected $module;

    /**
     * @var array (copy of Registry)
     * @since 2.0.0
     */
    protected $paramsArray = array();

    /**
     * @var string (xml)
     * @since 2.0.0
     */
    protected $xmlConfig = '';

    /**
     * @var int
     * @since 2.0.0
     *
     * NOTE to developers: just increase this number for more fields
     * BUT you will have to also increase the number of entries in mod_simpleemailform.xml
     */
    protected $maxFields = 8;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formPrefixName = 'mod_simpleemailform';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formRenderingOverrideName = '_renderingOverride';

    /**
     * @var int
     * @since 2.0.0
     */
    protected $formInstanceName = '_instance';

    /**
     * @var int
     * @since 2.0.0
     */
    protected $formSubmitButtonName = 'mod_simpleemailform_submit';

    /**
     * @var int
     * @since 2.0.0
     */
    protected $formResetButtonName = 'mod_simpleemailform_reset';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formCssClassName = '_cssClass';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formCol2SpaceName = '_col2space';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formLabelAlignName = '_labelAlign';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formAnchorName = '_anchor';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formUploadActiveName = '_uploadActive';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formCopymeLabelName = '_copymeLabel';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formCopymeActiveName = '_copymeActive';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formUseCaptchaName = '_useCaptcha';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formDefaultLangName = '_defaultLang';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formTestModeName = '_testMode';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldPrefixName = '_field';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldLabelName = 'label';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldValueName = 'value';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldSizeName = 'size';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldMaxxName = 'maxx';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldFromName = 'from';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldCkrfmtName = 'ckRfmt';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldCkrposName = 'ckRpos';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldEmailToName = '_emailTo';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldActiveName = 'active';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadName = '_upload';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadLabelName = '_uploadLabel';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadAllowedName = '_uploadAllowed';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadRequiredName = '_uploadRequired';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldCopymeName = '_copyMe';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $fieldCaptchaName = '_captcha';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailFileName = '_emailFile';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailCopymeAutoName = '_copymeAuto';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailToName = '_emailTo';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailCCName = '_emailCC';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailBCCName = '_emailBCC';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $replyToActiveName = '_replytoActive';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailReplyToName = '_emailReplyTo';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $addTitleName = '_addTitle';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailCopyme = 'N';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $emailCopymeLabel = '';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $lang = '';

    /**
     * @var array (string)
     * @since 2.0.0
     */
    protected $transLang = array();

    /**
     * @var array (string)
     * @since 2.0.0
     */
    protected $allowedHtmlTags = '<p><a><strong><span><em>
                                    <table><tbody><tr><td>
                                    <address><hr><img><ul><ol><li>
                                    <h1><h2><h3><h4><h5><h6>';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $uploadName = '';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $uploadLabel = '';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $uploadAllowedFiles = '';

    /**
     * @var array (string)
     * @since 2.0.0
     */
    protected $uploadAllowedFilesArray = array();

    /**
     * @var int
     * @since 2.0.0
     */
    protected $formInstance;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formAnchor;

    /**
     * @var bool
     * @since 2.0.0
     */
    protected $formRendering = true;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formTestMode = 'N';

    /**
     * @var array (string)
     * @since 2.0.0
     */
    protected $formActiveElements;

    /**
     * @var int
     * @since 2.0.0
     */
    protected $formActiveElementsCount;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formCssClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formTableClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formTrClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formThClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formSpaceClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formTdClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formInputClass;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formCaptchaClass;

    /**
     * @var int
     * @since 2.0.0
     */
    protected $formCol2Space;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $formLabelAlign;

    /**
     * @var string
     * @since 2.0.0
     */
    protected $successColour = 'green';

    /**
     * @var string
     * @since 2.0.0
     */
    protected $errorColour = 'red';

    /**
     * @var string (html)
     * @since 2.0.0
     */
    public $msg = '';

    /**
     * @var string (html)
     * @since 2.0.0
     */
    protected $output = '';

    /**
     * sefv2modsimpleemailform constructor.
     * @param JForm $jForm
     * @param JMail $jMail
     * @param sefv2simpleemailformemailmsg $emailMsg
     * @param JDocument $jDocument
     * @param JLanguage $jLanguage
     * @param Registry $params
     * @param JInput $jInput
     * @param JTableExtension $jTableExtension
     * @param JTableModule $jTableModule
     * @param stdClass $jModuleHelperResult
     * @param JSession $jSession
     * @param JFile $jFile
     *
     * @since 2.0.0
     */
    public function __construct(
        \JForm $jForm,
        \JMail $jMail,
        sefv2simpleemailformemailmsg $emailMsg,
        \JDocument $jDocument,
        \JLanguage $jLanguage,
        Registry $params,
        \JInput $jInput,
        \JTableExtension $jTableExtension,
        \JTableModule $jTableModule,
        \stdClass $jModuleHelperResult,
        \JSession $jSession,
        \JFile $jFile
    ) {
        $this->jForm = $jForm;
        $this->jMail = $jMail;
        $this->emailMsg = $emailMsg;
        $this->jDocument = $jDocument;
        $this->jLanguage = $jLanguage;
        $this->params = $params;
        $this->paramsArray = $params->toArray();
        $this->jInput = $jInput;
        $this->jTableExtension = $jTableExtension;
        $this->jTableModule = $jTableModule;
        $this->jModuleHelperResult = $jModuleHelperResult;
        $this->jSession = $jSession;
        $this->jFile = $jFile;

        // Check if automatic rendering has been turned off (user defined).
        if ($this->paramsArray[$this->formPrefixName . $this->formRenderingOverrideName] === 'Y') {
            $this->formRendering = false;
        }

        // Set the Joomla Registry's ($this->params and $this->paramsArray) property/key names.
        $this->formInstance = $this->paramsArray[$this->formPrefixName . $this->formInstanceName];

        $this->formAnchor = '#' . $this->paramsArray[$this->formPrefixName . $this->formAnchorName];

        $this->formCssClass = ($this->paramsArray[$this->formPrefixName . $this->formCssClassName])
            ? $this->paramsArray[$this->formPrefixName . $this->formCssClassName]
            : 'mod_sef';
        $this->formTableClass = $this->formCssClass . '_table';
        $this->formTrClass = $this->formCssClass . '_tr';
        $this->formThClass = $this->formCssClass . '_th';
        $this->formSpaceClass = $this->formCssClass . '_space';
        $this->formTdClass = $this->formCssClass . '_td';
        $this->formInputClass = $this->formCssClass . '_input';
        $this->formCaptchaClass = $this->formCssClass . '_captcha';
        $this->formCol2Space = $this->paramsArray[$this->formPrefixName . $this->formCol2SpaceName];
        $this->formLabelAlign = $this->paramsArray[$this->formPrefixName . $this->formLabelAlignName];

        switch ($this->formLabelAlign) {
            case 'L':
                $this->formLabelAlign = 'left';
                break;
            case 'R':
                $this->formLabelAlign = 'right';
                break;
            case 'C':
                $this->formLabelAlign = 'center';
                break;
        }

        /*
         * Load language files
         * i.e. en-GB.mod_simpleemailform.ini (JLanguage's default : en-GB)
         */
        $this->lang = $this->jLanguage->getTag();

        // Check and update the module's schema to match Joomla's chosen default language.
        if ($this->paramsArray[$this->formPrefixName . $this->formDefaultLangName] !== $this->lang) {
            $this->params->set($this->formPrefixName . $this->formDefaultLangName, $this->lang);

            $this->jComponentIds[0] = $this->jTableExtension->find(array('element' => 'mod_simpleemailform'));

            $this->jComponentIds[1] = $this->jModuleHelperResult->id;

            $this->jTableExtension->load($this->jComponentIds[0]);
            $this->jTableExtension->bind(array('params' => $this->params->toString()));

            $this->jTableModule->load($this->jComponentIds[1]);
            $this->jTableModule->bind(array('params' => $this->params->toString()));

            if (!$this->jTableExtension->check() || !$this->jTableModule->check()) {
                $this->msg .=
                    "<p style=\"color:{$this->errorColour}\">FATAL ERROR: Schema not ready for update.</p>";

                $this->formRendering = false;
            }

            if (!$this->jTableExtension->store() || !$this->jTableModule->store()) {
                $this->msg .=
                    "<p style=\"color:{$this->errorColour}\">FATAL ERROR: Schema not updated.</p>";

                $this->formRendering = false;
            }

            $this->paramsArray[$this->formPrefixName . $this->formDefaultLangName] = $this->lang;
        }

        // Load the appropriate translations file.
        $langFile = MOD_SIMPLEEMAILFORM_DIR
            . DIRECTORY_SEPARATOR
            . 'language_files'
            . DIRECTORY_SEPARATOR
            . $this->lang
            . '.mod_simpleemailform.ini';

        if (file_exists($langFile)) {
            $this->transLang = parse_ini_file($langFile);
        } else {
            $langFile = MOD_SIMPLEEMAILFORM_DIR
                . DIRECTORY_SEPARATOR
                . 'language_files'
                . DIRECTORY_SEPARATOR
                . 'en-GB.mod_simpleemailform.ini';

            $this->transLang = parse_ini_file($langFile);
        }

        if (empty($this->paramsArray[$this->formPrefixName . $this->emailToName])) {
            $this->msg .=
                "<p style=\"color:{$this->errorColour}\">{$this->transLang['MOD_SIMPLEEMAILFORM_email_invalid']}</p>";

            $this->formRendering = false;
        }

        // Determine the active fields that must be included in the form.
        $this->determineActiveElements($this->paramsArray);

        // Get the XML configuration for the active fields.
        $this->xmlConfig = $this->createXMLConfig($this->paramsArray);

        // Load the XML configuration into the JForm object.
        $this->load($this->xmlConfig);

        // Store test mode status.

        $this->formTestMode = $this->paramsArray[$this->formPrefixName . $this->formTestModeName];

        // Check if $_POST was set.
        if ($this->jInput->getMethod() === 'POST'
            && isset($_POST[$this->formSubmitButtonName . '_' . $this->formInstance])) {
            // CAUTION : $formDataRaw is not validated and is unfiltered and unsanitized!
            $formDataRaw = $this->jInput->post->getArray(array(), null, 'raw', true);

            // Check for file uploads
            $files = $this->jInput->files->getArray(array(), null, 'raw', true);

            // Validate, filter, sanitize and process the form data.
            $formProcessingResult = $this->processFormData($formDataRaw, $files, $this->paramsArray, $this->emailMsg);

            if ($formProcessingResult) {
                $this->msg .=
                    "<p style=\"color:{$this->successColour}\">{$this->transLang['MOD_SIMPLEEMAILFORM_form_success']}</p>";
            }

            // Reset the form before sending it back to the view.
            $this->reset();
        } elseif ($this->jInput->getMethod() === 'POST'
                  && isset($_POST[$this->formResetButtonName . '_' . $this->formInstance])) {
            $this->reset();
        }
    }

    /**
     * @param array $data
     *
     * @return bool
     *
     * @since 2.0.0
     */
    public function bind($data)
    {
        return $this->jForm->bind($data);
    }

    /**
     * @param array $paramsArray
     *
     * @return string
     *
     * @since 2.0.0
     */
    protected function createXMLConfig(array $paramsArray)
    {
        $xmlOutput = '';
        $xmlOutput .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xmlOutput .= "<form>\n";
        $xmlOutput .= "\t<fieldset name=\"main\">\n";

        for ($i = 1; $i <= $this->formActiveElementsCount; $i++) {
            $index = $i - 1;

            $labelKey = $this->formActiveElements[$index] . $this->fieldLabelName;
            $valueKey = $this->formActiveElements[$index] . $this->fieldValueName;
            $sizeKey = $this->formActiveElements[$index] . $this->fieldSizeName;
            $maxxKey = $this->formActiveElements[$index] . $this->fieldMaxxName;
            $fromKey = $this->formActiveElements[$index] . $this->fieldFromName;

            $active = $paramsArray[$this->formActiveElements[$index] . $this->fieldActiveName];
            $name = $this->formActiveElements[$index]
                . '_'
                . $this->formInstance;
            $label = $paramsArray[$labelKey];
            $value = $paramsArray[$valueKey];
            $size = $paramsArray[$sizeKey];
            $maxx = $paramsArray[$maxxKey];
            $from = $paramsArray[$fromKey];

            $xmlOutput .= "\t\t" . $this->getXMLField($active, $from, $name, $label, $value, $size, $maxx) . "\n";
        }

        if ($paramsArray[$this->formPrefixName . $this->formUploadActiveName] > 0) {
            $this->uploadLabel = $paramsArray[$this->formPrefixName . $this->fieldUploadLabelName];

            $this->uploadAllowedFilesArray =
                (!empty($paramsArray[$this->formPrefixName . $this->fieldUploadAllowedName]))
                    ? explode(',', $paramsArray[$this->formPrefixName . $this->fieldUploadAllowedName])
                    : array();

            if (!empty($this->uploadAllowedFilesArray)) {
                array_walk($this->uploadAllowedFilesArray, function (&$item, &$key) {
                    $item = '.' . strtolower($item);
                });

                $this->uploadAllowedFiles = implode(", ", $this->uploadAllowedFilesArray);
            } else {
                $this->uploadAllowedFiles = '';
            }

            for ($i = 1; $i <= $paramsArray[$this->formPrefixName . $this->formUploadActiveName]; $i++) {
                $this->uploadName[$i] = $this->formPrefixName
                    . $this->fieldUploadName
                    . $i
                    . '_'
                    . $this->formInstance;

                if ($i > 1) {
                    $this->uploadLabel = '';
                }

                $xmlOutput .= "\t\t" . $this->getXMLUploadField(
                    $this->uploadName[$i],
                    $this->uploadLabel,
                    $this->uploadAllowedFiles
                ) . "\n";
            }
        }

        if ($paramsArray[$this->formPrefixName . $this->formCopymeActiveName] !== 'N') {
            $copymeName = $this->formPrefixName . $this->fieldCopymeName . '_' . $this->formInstance;
            $xmlOutput .= "\t\t" . $this->getXMLField(
                'Y',
                'C',
                $copymeName,
                $paramsArray[$this->formPrefixName . $this->formCopymeLabelName],
                '1',
                '',
                ''
            ) . "\n";
        }

        if ($paramsArray[$this->formPrefixName . $this->formUseCaptchaName] !== 'N') {
            $captchaName = $this->formPrefixName . $this->fieldCaptchaName . '_' . $this->formInstance;
            $xmlOutput .= "\t\t" . $this->getXMLCaptchaField(
                $captchaName,
                $this->formPrefixName . '_' . $this->formInstance
            ) . "\n";
        }

        $xmlOutput .= "\t</fieldset>\n";
        $xmlOutput .= "</form>\n";

        return $xmlOutput;
    }

    /**
     * @param string $input
     * @param null $label
     *
     * @return string
     *
     * @since 2.0.0
     */
    public function decorateInput($input, $label = null)
    {
        $decoratedInput = '';

        $input = (string) $input;

        $tr = "\t\t<tr class=\"{$this->formTrClass}\">";
        $trClose = '</tr>';
        $td = "<td class=\"{$this->formTdClass}\">";
        $tdClose = '</td>';

        // If no label, field is hidden.
        if (!isset($label)) {
            $decoratedInput .= $tr . $td . $input . $tdClose . $trClose . "\n";
        } else {
            $label = (string) $label;

            $matchesInput = array();
            $matchesLabel = array();
            $matchesLabelTag = array();

            $resultInput = preg_match_all('/<input.+?>/is', $input, $matchesInput);

            if ($resultInput > 1) {
                $lookBehind = $this->formPrefixName . $this->fieldPrefixName;

                $pattern = "/(?<=$lookBehind)[0-9]{1}(?=_[0-9])/is";

                $fieldNumberArray = array();

                preg_match($pattern, $input, $fieldNumberArray);

                $ckRfmt = $this->paramsArray[
                    $this->formPrefixName
                    . $this->fieldPrefixName
                    . $fieldNumberArray[0]
                    . $this->fieldCkrfmtName
                ];

                $ckRpos = $this->paramsArray[
                    $this->formPrefixName
                    . $this->fieldPrefixName
                    . $fieldNumberArray[0]
                    . $this->fieldCkrposName
                ];

                $th = '';

                $multiInput = '<table>';

                if (strpos($input, 'type="checkbox"') !== false) {
                    preg_match_all('/(?<=>).{1,40}(?=<\/label>)/is', $input, $matchesLabel);
                } else {
                    preg_match_all('/(?<=\s>).{1,100}(?=<\/label>)/is', $input, $matchesLabel);
                }

                preg_match_all('/<label.+?>/is', $input, $matchesLabelTag);

                for ($i = 0; $i < $resultInput; $i++) {
                    if ($ckRfmt === 'H') {
                        $multiInputFormat = $tr
                            . $td
                            . '%BEFORE%'
                            . $tdClose
                            . $td
                            . '%AFTER%'
                            . $tdClose
                            . $trClose;
                    } elseif ($ckRfmt === 'V') {
                        $multiInputFormat = $tr
                            . $td
                            . '%BEFORE%'
                            . $tdClose
                            . $trClose
                            . $tr
                            . $td
                            . '%AFTER%'
                            . $tdClose
                            . $trClose;
                    } else {
                        $multiInputFormat = '%BEFORE%%AFTER%';
                    }

                    $inputLabel = $matchesLabelTag[0][$i] . $matchesLabel[0][$i] . '</label>';

                    if ($ckRpos === 'A') {
                        $multiInputFormat2 = str_replace('%AFTER%', $inputLabel, $multiInputFormat);
                        $multiInput .= str_replace('%BEFORE%', $matchesInput[0][$i], $multiInputFormat2);
                    } else {
                        $multiInputFormat2 = str_replace('%BEFORE%', $inputLabel, $multiInputFormat);
                        $multiInput .= str_replace('%AFTER%', $matchesInput[0][$i], $multiInputFormat2);
                    }
                }

                $multiInput .= '</table>';
                $multiInput .= "\n";

                $input = $multiInput;
            }

            $th = "<th align=\"{$this->formLabelAlign}\" 
                        style=\"text-align:{$this->formLabelAlign};\" 
                        class=\"{$this->formThClass}\">
                    $label
                </th>";

            $decoratedInput .= $tr . $th . $td . $input . $tdClose . $trClose . "\n";
        }

        return $decoratedInput;
    }

    /**
     * @param array $paramsArray
     *
     * @return bool
     *
     * @since 2.0.0
     */
    protected function determineActiveElements(array $paramsArray)
    {
        $this->formActiveElements = array();

        $formActiveElements = array();

        // We will use array_walk_recursive() in case we receive a multi-dimensional array.
        array_walk_recursive($paramsArray, function ($item, $key) use (&$formActiveElements) {
            if (preg_match("/$this->fieldActiveName/", $key) === 1 && $item !== 'N') {
                $formActiveElements[] = substr($key, 0, strlen($key) - strlen($this->fieldActiveName));
            }
        });

        $this->formActiveElements = $formActiveElements;

        $this->formActiveElementsCount = count($this->formActiveElements);

        if ($this->formActiveElementsCount === 0) {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @param null $group
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function filter(array $data, $group = null)
    {
        return $this->jForm->filter($data, $group);
    }

    /**
     *
     * @return Registry
     *
     * @since 2.0.0
     */
    public function getData()
    {
        return $this->jForm->getData();
    }

    /**
     *
     * @return array
     *
     * @since 2.0.0
     */
    public function getErrors()
    {
        return $this->jForm->getErrors();
    }

    /**
     * @param string $name
     * @param null $group
     * @param null $value
     *
     * @return bool|JFormField
     *
     * @since 2.0.0
     */
    public function getField($name, $group = null, $value = null)
    {
        $name = (string) $name;

        return $this->jForm->getField($name, $group, $value);
    }

    /**
     * @param null $set
     *
     * @return array
     *
     * @since 2.0.0
     */
    public function getFieldset($set = null)
    {
        return $this->jForm->getFieldset($set);
    }

    /**
     * @param string $active
     * @param string $from
     * @param string $name
     * @param string $label
     * @param string $value
     * @param string $size
     * @param string $maxx
     *
     * @return string
     *
     * @since 2.0.0
     */
    protected function getXMLField($active, $from, $name, $label, $value, $size, $maxx)
    {
        $active = (string) $active;
        $from = (string) $from;
        $name = (string) $name;
        $label = (string) $label;
        $value = (string) $value;
        $size = (string) $size;
        $maxx = (string) $maxx;

        $type = '';
        $required = '';
        $validate = '';
        $xmlField = '';

        if ($active === 'H') {
            $xmlField .= "<field
                    type=\"hidden\"
                    name=\"$name\"
                    default=\"$value\" />";

            return $xmlField;
        } elseif ($active === 'R') {
            $required .= 'required';
        }

        switch ($from) {
            case 'F':
            case 'S':
                if ($from === 'F') {
                    $type .= 'email';
                    $validate .= 'email';
                } else {
                    $type .= 'text';
                }

                $xmlField .= "<field
                    type=\"$type\"
                    name=\"$name\"
                    id=\"$name\"
                    label=\"$label\"
                    size=\"$size\"
                    maxLength=\"$maxx\"
                    required=\"$required\"
                    validate=\"$validate\"
                    value=\"$value\" />";
                break;
            case 'R':
            case 'C':
            case 'D':
                if ($from === 'R') {
                    $type .= 'radio';
                } elseif ($from !== 'C') {
                    $type .= 'list';
                }

                $multiValue = '';
                $valueArray = explode(',', $value);

                if (count($valueArray) > 1) {
                    foreach ($valueArray as $multiOptions) {
                        $valuesToInsert = explode('=', $multiOptions);
                        $valuesToInsert = array_map('trim', $valuesToInsert);
                        $multiValue .= "<option value=\"$valuesToInsert[0]\">$valuesToInsert[1]</option>";
                    }

                    if ($from === 'C') {
                        $type .= 'checkboxes';
                    }
                } else {
                    if ($from === 'C') {
                        $type .= 'checkbox';
                    }
                }

                $xmlField .= "<field
                    type=\"$type\"
                    name=\"$name\"
                    id=\"$name\"
                    label=\"$label\"
                    required=\"$required\">
                        $multiValue
                    </field>";
                break;
            case 'A':
                $areaSizeArray = explode(',', $size);

                if (count($areaSizeArray) < 2) {
                    $areaSizeArray[] = $size;
                }

                array_walk($areaSizeArray, function (&$item, &$key) {
                    $item = (string) trim($item);
                });

                $xmlField .= "<field
                    type=\"editor\"
                    name=\"$name\"
                    id=\"$name\"
                    label=\"$label\"
                    rows=\"{$areaSizeArray[0]}\"
                    cols=\"{$areaSizeArray[1]}\"
                    required=\"$required\" />";
                break;
            default:
                $xmlField .= "<field
                    type=\"text\"
                    name=\"$name\"
                    id=\"$name\"
                    label=\"$label\"
                    size=\"$size\"
                    maxLength=\"$maxx\"
                    value=\"$value\"
                    required=\"$required\" />";
        }

        return $xmlField;
    }

    /**
     * @param string $uploadName
     * @param string $uploadLabel
     * @param string $uploadAllowedFiles
     *
     * @return string
     *
     * @since 2.0.0
     */
    protected function getXMLUploadField($uploadName, $uploadLabel, $uploadAllowedFiles)
    {
        $uploadName = (string) $uploadName;
        $uploadLabel = (string) $uploadLabel;
        $uploadAllowedFiles = (string) $uploadAllowedFiles;

        $uploadField = '';

        $uploadField .= "<field 
                            name=\"$uploadName\"
                            type=\"file\"
                            label=\"$uploadLabel\"
                            description=\"{$this->transLang['MOD_SIMPLEEMAILFORM_attachment']}\"
                            size=\"10\"
                            accept=\"$uploadAllowedFiles\" />";

        return $uploadField;
    }

    /**
     * @param string $name
     * @param string $namespace
     *
     * @return string
     *
     * @since 2.0.0
     */
    protected function getXMLCaptchaField($name, $namespace)
    {
        $name = (string) $name;

        $namespace = (string) $namespace;

        $captchaField = '';

        $captchaField .= "<field
                            name=\"$name\"
                            type=\"captcha\"
                            validate=\"captcha\"
                            namespace=\"$namespace\"
                            label=\"{$this->transLang['MOD_SIMPLEEMAILFORM_captcha_please_help']}\"
                            description=\"{$this->transLang['MOD_SIMPLEEMAILFORM_captcha_please_enter']}\">
                           </field>";

        return $captchaField;
    }

    /**
     * @param string $xmlConfigString
     *
     *
     * @since 2.0.0
     */
    public function load($xmlConfigString)
    {
        $this->jForm->load($xmlConfigString);
    }

    /**
     * @param array $formDataRaw
     * @param array $files
     * @param array $paramsArray
     * @param sefv2simpleemailformemailmsg $emailMsg
     *
     * @return bool
     *
     * @since 2.0.0
     */
    protected function processFormData(array $formDataRaw, array $files, array $paramsArray, sefv2simpleemailformemailmsg $emailMsg)
    {
        // Check for CSRF token match.
        if (!($this->jSession->checkToken())) {
            $this->msg .=
                "<p style=\"color:{$this->errorColour}\">\"Invalid Token\" - {$this->transLang['MOD_SIMPLEEMAILFORM_form_unable']}</p>";

            return false;
        }

        // Validate the form data.
        if (!$this->validate($formDataRaw)) {
            $errors = $this->getErrors();

            // Get the error message from the JForm object and send it to the view.
            foreach ($errors as $error) {
                $errorMsg = $error->getMessage();

                if (strpos($errorMsg, ':') !== false) {
                    $fieldNameArray = explode(':', $error->getMessage());
                    $errorMsg = trim(end($fieldNameArray));
                } else {
                    $errorMsg = trim($errorMsg);
                }

                $this->msg .=
                    "<p style=\"color:{$this->errorColour}\">\"$errorMsg\" - {$this->transLang['MOD_SIMPLEEMAILFORM_form_unable']}</p>";
            }

            return false;
        }

        // Filter and sanitize the form data.
        array_walk_recursive($formDataRaw, function (&$item, &$key) {
            $item = (string) trim(strip_tags($item, $this->allowedHtmlTags));
        });

        // Filter active fields by limiting the maximum length of input per field.
        for ($i = 0; $i < $this->formActiveElementsCount; $i++) {
            $maxLength = $paramsArray[$this->formActiveElements[$i] . $this->fieldSizeName];

            if (strpos($maxLength, ',') !== false) {
                $maxLengthArray = explode(',', $maxLength);
                $maxLength = $maxLengthArray[0] * $maxLengthArray[1];
            }

            if (is_array($formDataRaw[$this->formActiveElements[$i] . '_' . $this->formInstance])) {
                foreach ($formDataRaw[$this->formActiveElements[$i] . '_' . $this->formInstance] as $value) {
                    $value = substr($value, 0, $maxLength);
                }
            } else {
                $formDataRaw[$this->formActiveElements[$i] . '_' . $this->formInstance] =
                    substr(
                        $formDataRaw[$this->formActiveElements[$i] . '_' . $this->formInstance],
                        0,
                        $maxLength
                    );
            }
        }

        // Move clean data to a new variable.
        $formDataClean = $formDataRaw;
        $formDataRaw = null;

        $this->bind($formDataClean);

        // IMPORTANT : This loop will not run if there are no (0) configured upload fields.
        for ($i = 1; $i <= $paramsArray[$this->formPrefixName . $this->formUploadActiveName]; $i++) {
            if (!empty($files[$this->uploadName[$i]]['tmp_name']) && $files[$this->uploadName[$i]]['error'] === 0) {
                $uploadFileResult = $this->uploadFile(
                    $files[$this->uploadName[$i]]['name'],
                    $files[$this->uploadName[$i]]['tmp_name'],
                    $this->jFile
                );
            } elseif (!empty($files[$this->uploadName[$i]]['tmp_name']) && $files[$this->uploadName[$i]]['error'] !== 0) {
                $uploadFileResult = false;
            } else {
                if ($paramsArray[$this->formPrefixName . $this->fieldUploadRequiredName] === 'Y') {
                    $uploadFileResult = false;
                } else {
                    // IMPORTANT : Must return true if no file was submitted (i.e. optional field(s)).
                    $uploadFileResult = true;
                }
            }

            if (!$uploadFileResult) {
                $this->msg =
                    "<p style=\"color:{$this->errorColour}\">{$this->transLang['MOD_SIMPLEEMAILFORM_upload_error']}</p>";
                return false;
            }
        }

        // 2012-02-15 DB: Override unwanted error messages originating from JMail.
        ob_start();

        $sendFormResult = $this->sendFormData($formDataClean, $paramsArray, $emailMsg, $this->jMail);

        ob_end_clean();

        if (!$sendFormResult) {
            return false;
        }

        return true;
    }

    /**
     * @param string $name
     * @param null $group
     *
     * @return bool
     *
     * @since 2.0.0
     */
    public function removeField($name, $group = null)
    {
        $name = (string) $name;

        return $this->jForm->removeField($name, $group);
    }

    /**
     *
     * @return string
     *
     * @since 2.0.0
     */
    public function render()
    {
        if (!$this->formRendering) {
            return $this->msg;
        }

        // Present the Email Form.
        $this->output .= !empty($this->formCssClass)
            ? "<div class=\"" . $this->formCssClass . "\">\n"
            : '';

        // 2012-04-20 DB: Added anchor (default anchor = #).
        $this->output .=
            '<a id="'
            . $this->formAnchor
            . '" name="'
            . $this->formAnchor
            . '">&nbsp;</a>'
            . "\n";

        $this->output .= "<form method=\"post\" "
            . "action=\"" . $this->formAnchor . "\" "
            . "name=\"_SimpleEmailForm_" . $this->formInstance . "\" "
            . "id=\"_SimpleEmailForm_" . $this->formInstance . "\" "
            . "enctype=\"multipart/form-data\">\n";

        $this->output .= "<table class='" . $this->formTableClass . "'>\n";

        $this->output .= "\t<tbody>\n";

        $fieldSets = $this->getFieldset('main');

        if (!empty($fieldSets)) {
            foreach ($fieldSets as $fieldName => $field) {
                if ($field->hidden) {
                    $this->output .= $this->decorateInput($field->input);
                } else {
                    $this->output .= $this->decorateInput($field->input, $field->label);
                }
            }
        }

        $this->output .= $this->decorateInput(\JHtml::_('form.token'));

        $this->output .= "\t</tbody>\n";

        $this->output .= "</table>\n";

        $this->output .= "<br /><input
                                        class=\"{$this->formInputClass}\"
                                        name=\"{$this->formSubmitButtonName}_{$this->formInstance}\"
                                        id=\"{$this->formSubmitButtonName}_{$this->formInstance}\"
                                        value=\"{$this->transLang['MOD_SIMPLEEMAILFORM_button_submit']}\"
                                        title=\"{$this->transLang['MOD_SIMPLEEMAILFORM_click_submit']}\"
                                        type=\"submit\">\n";

        $this->output .= "<input
                                class=\"{$this->formInputClass}\"
                                name=\"{$this->formResetButtonName}_{$this->formInstance}\"
                                id=\"{$this->formResetButtonName}_{$this->formInstance}\"
                                value=\"{$this->transLang['MOD_SIMPLEEMAILFORM_button_reset']}\"
                                title=\"\"
                                type=\"reset\">\n";

        $this->output .= "</form>\n";

        if ($this->formTestMode === 'Y') {
            $this->output = htmlspecialchars($this->output);
            return '<pre>' . htmlspecialchars($this->testDump($this)) . '</pre>';
        }

        $this->output .= $this->msg;

        return $this->output;
    }

    /**
     * @param bool $xml
     *
     * @return bool
     *
     * @since 2.0.0
     */
    public function reset($xml = false)
    {
        return $this->jForm->reset($xml);
    }

    /**
     * @param array $formDataClean
     * @param array $paramsArray
     * @param sefv2simpleemailformemailmsg $emailMsg
     * @param JMail $jMail
     *
     * @return bool
     *
     * @since 2.0.0
     */
    protected function sendFormData(array $formDataClean, array $paramsArray, sefv2simpleemailformemailmsg $emailMsg, \JMail $jMail)
    {
        //Configure the email message's general options.
        $emailMsg->to = trim($paramsArray[$this->formPrefixName . $this->emailToName]);
        $emailMsg->to = (preg_match('/[\s,]+/', $emailMsg->to))
            ? preg_split('/[\s,]+/', $emailMsg->to)
            : array($emailMsg->to);
        $emailMsg->cc  = trim($paramsArray[$this->formPrefixName . $this->emailCCName]);
        $emailMsg->bcc = trim($paramsArray[$this->formPrefixName . $this->emailBCCName]);
        if ($emailMsg->cc) {
            $emailMsg->cc  = (preg_match('/[\s,]+/', $emailMsg->cc))
                ? preg_split('/[\s,]+/', $emailMsg->cc)
                : array($emailMsg->cc);
        }

        if ($emailMsg->bcc) {
            $emailMsg->bcc = (preg_match('/[\s,]+/', $emailMsg->bcc))
                ? preg_split('/[\s,]+/', $emailMsg->bcc)
                : array($emailMsg->bcc);
        }

        // Set the attachments directory.
        $emailMsg->dir = trim($paramsArray[$this->formPrefixName . $this->emailFileName]);

        // 2012-02-07 DB: Add optional Reply-To field.
        $emailMsg->replyToActive  = $paramsArray[$this->formPrefixName . $this->replyToActiveName];

        if ($emailMsg->replyToActive == 'Y') {
            // 2016-04-18 DB: ReplyTo no longer needs to be an array.
            $emailMsg->replyTo = $paramsArray[$this->formPrefixName . $this->emailReplyToName];

            if (version_compare(JVERSION, '3.0', 'ge')) {
                $emailMsg->replyTo = $paramsArray[$this->formPrefixName . $this->emailReplyToName];
            } else {
                $emailMsg->replyTo = array(
                    $paramsArray[$this->formPrefixName . $this->emailReplyToName]
                );
            }
        } else {
            $emailMsg->replyTo = '';
        }

        // Build the body of the email message.
        $emailMsg->subject = '';
        $emailMsg->body =  '';

        // 2013-09-01 DB: Added article title.
        if ($paramsArray[$this->formPrefixName . $this->addTitleName] === 'Y') {
            $emailMsg->body .= "\nArticle Title: " . $this->jDocument->getTitle();
        }

        for ($i = 1; $i <= $this->formActiveElementsCount; $i++) {
            $index = $i - 1;

            $activeKey = $this->formActiveElements[$index] . $this->fieldActiveName;
            $active = $paramsArray[$activeKey];

            $fromKey = trim($this->formActiveElements[$index] . $this->fieldFromName);
            $from = $paramsArray[$fromKey];

            $labelKey = trim($this->formActiveElements[$index] . $this->fieldLabelName);
            $label = $paramsArray[$labelKey];

            $postValueKey = $this->formActiveElements[$index] . '_' . $this->formInstance;
            $value = $formDataClean[$postValueKey];

            if ($active !== 'H' && $from === 'F') {
                $emailMsg->from = $value;
            } elseif ($active !== 'H' && $from === 'S') {
                $emailMsg->subject = $value;
            } else {
                // Otherwise, pull value from filtered and sanitized $_POST.
                // 2013-04-20 DB: Added check for array -- to account for checkboxes / multi-select.
                if (isset($value)) {
                    if (is_array($value)) {
                        $value = implode(" / ", $value);
                    }
                }

                $emailMsg->body .= ($value)
                    ? "\n" . $label . ': ' . $value
                    : '';
            }
        }

        // 2010-05-03 DB: Filter for \n in subject.
        $emailMsg->subject = str_replace("\n", '', $emailMsg->subject);

        // Strip slashes.
        $emailMsg->body = stripslashes($emailMsg->body);

        // Send mail.
        $jMail->addRecipient($emailMsg->to);
        $jMail->setSender($emailMsg->from);
        $jMail->setSubject($emailMsg->subject);
        $jMail->setBody($emailMsg->body);

        // 2012-02-03 DB: Added reply to field (has to be an array).
        if ($emailMsg->cc) {
            $jMail->addCC($emailMsg->cc);
        }

        if ($emailMsg->bcc) {
            $jMail->addBCC($emailMsg->bcc);
        }

        if ($emailMsg->replyTo) {
            $jMail->addReplyTo($emailMsg->replyTo);
        }

        // 2012-02-15 DB: Set up attachments as an array.
        if (count($emailMsg->attachment) > 0) {
            // Attach files.
            foreach ($emailMsg->attachment as $fullPathFileName) {
                if (isset($fullPathFileName)) {
                    $jMail->addAttachment($fullPathFileName);
                }
            }
        }

        try {
            if (!$sent = $jMail->send()) {
                return false;
            }

            // Check the copyMe option from the submitted form.
            $emailMsg->copyMe = (isset($formDataClean[$this->formPrefixName . $this->fieldCopymeName . '_' . $this->formInstance]))
                ? true
                : false;

            // Check the copymeAuto option in the Joomla Registry ($params).
            $emailMsg->copyMeAuto = ($paramsArray[$this->formPrefixName . $this->emailCopymeAutoName] === 'Y')
                ? true
                : false;

            // Send copyMe email if copyMe or copyMeAuto are set to TRUE.
            // 2011-08-12 DB: added option for copyMeAuto
            if ($emailMsg->copyMe === true || $emailMsg->copyMeAuto === true) {
                $jMail->clearAllRecipients();
                $jMail->addRecipient($emailMsg->from, $emailMsg->fromName);
                if (!$sent = $jMail->send()) {
                    return false;
                }
            }
        } catch (Exception $e) {
            $this->msg .= '<p style="color:' . $this->errorColour . '">'
                . $this->transLang['MOD_SIMPLEEMAILFORM_error'] . ' : Mail Server</p>';
            $this->msg .= '<p style="color:' . $this->errorColour . '">'
                . $this->transLang['MOD_SIMPLEEMAILFORM_email_invalid'];
            /*if ($this->paramsArray[$this->formPrefixName . $this->formTestModeName] == 'Y') {
                $this->msg .= '<p style="color:' . $this->errorColour . '">' . $e->getMessage() . "</p>\n";
                $this->msg .= '<p style="color:' . $this->errorColour . '">' . $e->getTraceAsString() . "</p>\n";
            }*/
            return false;
        }

        return true;
    }

    // 2016-12-21 AC: Thanks to Anthony Scaife for this method.
    /**
     * @param mixed $data
     * @param int $indent
     *
     * @return string
     *
     * @since 2.0.0
     */
    protected function testDump($data, $indent = 0)
    {
        $retval = '';

        $prefix=\str_repeat(' |  ', $indent);

        if (\is_numeric($data)) {
            $retval.= "Number: $data";
        } elseif (\is_string($data)) {
            $retval.= "String: '$data'";
        } elseif (\is_null($data)) {
            $retval.= "NULL";
        } elseif ($data===true) {
            $retval.= "TRUE";
        } elseif ($data===false) {
            $retval.= "FALSE";
        } elseif (is_array($data)) {
            $retval.= "Array (".count($data).')';
            $indent++;

            foreach ($data as $key => $value) {
                $retval.= "\n$prefix [$key] = ";
                $retval.= $this->testDump($value, $indent);
            }
        } elseif (is_object($data)) {
            $retval.= "Object (".get_class($data).")";
            $indent++;

            foreach ($data as $key => $value) {
                $retval.= "\n$prefix $key -> ";
                $retval.= $this->testDump($value, $indent);
            }
        }

        return $retval;
    }

    /**
     * @param string fileName
     * @param string $fileTmpName
     * @param JFile $jFile
     *
     * @return bool
     *
     * @since 2.0.0
     */
    protected function uploadFile($fileName, $fileTmpName, \JFile $jFile)
    {
        $fileName = (string) $fileName;
        $fileTmpName = (string) $fileTmpName;

        //Clean up filename to get rid of strange characters like spaces, etc.
        $fileName = $jFile->makeSafe($fileName);

        // Get the file directory's path (user defined)
        $dir = $this->paramsArray[$this->formPrefixName . $this->emailFileName];

        //Set up the source and destination of the file
        $src = $fileTmpName;
        $dest = $dir
            . DIRECTORY_SEPARATOR
            . md5($fileTmpName)
            . $fileName;

        //First check if the file has the right extension
        if (in_array('.' . strtolower($jFile->getExt($fileName)), $this->uploadAllowedFilesArray)
            || empty($this->uploadAllowedFilesArray)) {
            // Move the file
            if ($jFile->upload($src, $dest)) {
                // Add the file's attachment
                $this->emailMsg->attachment[] = $dest;
                $this->msg .=
                    "<p style=\"color:{$this->successColour}\">{$this->transLang['MOD_SIMPLEEMAILFORM_upload_success']}</p>";
                return true;
            } else {
                $this->msg .=
                    "<p style=\"color:{$this->errorColour}\">{$this->transLang['MOD_SIMPLEEMAILFORM_upload_failure']}</p>";
                return false;
            }
        } else {
            $this->msg .=
                "<p style=\"color:{$this->errorColour}\">{$this->transLang['MOD_SIMPLEEMAILFORM_disallowed_filename']}</p>";
            return false;
        }
    }

    /**
     * @param array $data
     * @param null $group
     *
     * @return bool
     *
     * @since 2.0.0
     */
    public function validate(array $data, $group = null)
    {
        return $this->jForm->validate($data, $group);
    }
}
