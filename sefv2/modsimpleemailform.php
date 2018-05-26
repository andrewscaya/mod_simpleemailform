<?php

/**
 * modsimpleemailform.php
 *
 * Copyright 2010 - 2018 D. Bierer <doug@unlikelysource.com>
 * Version 2.3.0
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 * @package    Simple Email Form
 * @copyright  Copyright 2010 - 2018 D. Bierer <doug@unlikelysource.com>
 * @link       http://joomla.unlikelysource.org/
 * @license    GNU/GPLv2, see above
 * @since 2.0.0
 */

use \Joomla\Registry\Registry;

/**
 * Main implementation of version 2 of the Simple Email Form module.
 *
 * @package Simple Email Form
 *
 * @since 2.0.0
 */
class sefv2modsimpleemailform implements
    sefv2jformproxyinterface,
    sefv2formrendererinterface,
    sefv2customrenderinginterface
{

    /**
     * Contains an instance of a JForm object.
     *
     * @var JForm
     * @since 2.0.0
     */
    protected $jForm;

    /**
     * Contains an instance of a JMail object.
     *
     * @var JMail
     * @since 2.0.0
     */
    protected $jMail;

    /**
     * Contains an instance of a sefv2simpleemailformemailmsg object.
     *
     * @var sefv2simpleemailformemailmsg
     * @since 2.0.0
     */
    protected $emailMsg;

    /**
     * Contains an instance of a JDocument object.
     *
     * @var JDocument
     * @since 2.0.0
     */
    protected $jDocument;

    /**
     * Contains an instance of a JLanguage object.
     *
     * @var JLanguage
     * @since 2.0.0
     */
    protected $jLanguage;

    /**
     * Contains an instance of a Joomla\Registry\Registry object.
     *
     * @var Registry
     * @since 2.0.0
     */
    protected $params;

    /**
     * Contains an instance of a JInput object.
     *
     * @var JInput
     * @since 2.0.0
     */
    protected $jInput;

    /**
     * Contains an instance of a JTableExtension object.
     *
     * @var JTableExtension
     * @since 2.0.0
     */
    protected $jTableExtension;

    /**
     * Contains an instance of a JTableModule object.
     *
     * @var JTableModule
     * @since 2.0.0
     */
    protected $jTableModule;

    /**
     * Contains an instance of a stdClass object.
     *
     * @var stdClass
     * @since 2.0.0
     */
    protected $jModuleHelperResult;

    /**
     * Contains an instance of a JSession object.
     *
     * @var JSession
     * @since 2.0.0
     */
    protected $jSession;

    /**
     * Contains an instance of a JFile object.
     *
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
     * Contains an array of module identifiers in the Joomla system.
     *
     * @var stdClass
     * @since 2.0.0
     */
    protected $module;

    /**
     * Contains an array version of the Joomla\Registry\Registry object.
     *
     * @var array (copy of Registry)
     * @since 2.0.0
     */
    protected $paramsArray = array();

    /**
     * Contains an XML string signifying the form's configuration.
     *
     * @var string
     * @since 2.0.0
     */
    protected $xmlConfig = '';

    /**
     * Contains an integer of the maximum number of configurable fields.
     *
     * @var int
     * @since 2.0.0
     *
     * NOTE to developers: just increase this number for more fields
     * BUT you will have to also increase the number of entries in mod_simpleemailform.xml
     */
    protected $maxFields = 8;

    /**
     * Contains a string signifying the prefix name of the fields found in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formPrefixName = 'mod_simpleemailform';

    /**
     * Contains a string signifying the name of the renderingOverride field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formRenderingOverrideName = '_renderingOverride';

    /**
     * Contains a string signifying the name of the stringOverride field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formStringOverrideName = '_stringOverride';

    /**
     * Contains a string signifying the name of the instance field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formInstanceName = '_instance';

    /**
     * Contains a string signifying the name of the mod_simpleemailform_submit button parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formSubmitButtonName = 'mod_simpleemailform_submit';

    /**
     * Contains a string signifying the name of the mod_simpleemailform_reset button parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formResetButtonName = 'mod_simpleemailform_reset';

    /**
     * Contains a string signifying the name of Simple Email Form's CSS class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formCssClassName = '_cssClass';

    /**
     * Contains a string signifying the name of Simple Email Form's redirectURL parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formRedirectURLName = '_redirectURL';

    /**
     * Contains a string signifying the name of Simple Email Form's col2space parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formCol2SpaceName = '_col2space';

    /**
     * Contains a string signifying the name of Simple Email Form's labelAlign parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formLabelAlignName = '_labelAlign';

    /**
     * Contains a string signifying the name of Simple Email Form's errorTxtColor parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formErrorColourName = '_errorTxtColor';

    /**
     * Contains a string signifying the name of Simple Email Form's successTxtColor parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formSuccessColourName = '_successTxtColor';

    /**
     * Contains a string signifying the name of Simple Email Form's anchor parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formAnchorName = '_anchor';

    /**
     * Contains a string signifying the name of Simple Email Form's uploadActive parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formUploadActiveName = '_uploadActive';

    /**
     * Contains a string signifying the name of Simple Email Form's copymeLabel parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formCopymeLabelName = '_copymeLabel';

    /**
     * Contains a string signifying the name of Simple Email Form's copymeActive parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formCopymeActiveName = '_copymeActive';

    /**
     * Contains a string signifying the name of Simple Email Form's useCaptcha parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formUseCaptchaName = '_useCaptcha';

    /**
     * Contains a string signifying the name of the defaultLang field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formDefaultLangName = '_defaultLang';

    /**
     * Contains a string signifying the name of the testMode field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formTestModeName = '_testMode';

    /**
     * Contains a string signifying the name of the field field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldPrefixName = '_field';

    /**
     * Contains a string signifying the name of the field label field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldLabelName = 'label';

    /**
     * Contains a string signifying the name of the field value field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldValueName = 'value';

    /**
     * Contains a string signifying the name of the field size field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldSizeName = 'size';

    /**
     * Contains a string signifying the name of the field maxx field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldMaxxName = 'maxx';

    /**
     * Contains a string signifying the name of the field from field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldFromName = 'from';

    /**
     * Contains a string signifying the name of the field ckRfmt field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldCkrfmtName = 'ckRfmt';

    /**
     * Contains a string signifying the name of the field ckRpos field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldCkrposName = 'ckRpos';

    /**
     * Contains a string signifying the name of the emailTo field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldEmailToName = '_emailTo';

    /**
     * Contains a string signifying the name of the field active field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldActiveName = 'active';

    /**
     * Contains a string signifying the name of the upload field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadName = '_upload';

    /**
     * Contains a string signifying the name of the upload label field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadLabelName = '_uploadLabel';

    /**
     * Contains a string signifying the name of the uploadAllowed field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadAllowedName = '_uploadAllowed';

    /**
     * Contains a string signifying the name of the uploadRequired field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldUploadRequiredName = '_uploadRequired';

    /**
     * Contains a string signifying the name of the copyMe field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldCopymeName = '_copyMe';

    /**
     * Contains a string signifying the name of the captcha field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $fieldCaptchaName = '_captcha';

    /**
     * Contains a string signifying the name of the emailFile field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailFileName = '_emailFile';

    /**
     * Contains a string signifying the name of the copymeAuto field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailCopymeAutoName = '_copymeAuto';

    /**
     * Contains a string signifying the name of the copymeContent field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.1.0
     */
    protected $emailCopymeContentName = '_copymeContent';

    /**
     * Contains a string signifying the name of the emailTo field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailToName = '_emailTo';

    /**
     * Contains a string signifying the name of the emailCC field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailCCName = '_emailCC';

    /**
     * Contains a string signifying the name of the emailBCC field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailBCCName = '_emailBCC';

    /**
     * Contains a string signifying the name of the replytoActive field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $replyToActiveName = '_replytoActive';

    /**
     * Contains a string signifying the name of the emailReplyTo field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailReplyToName = '_emailReplyTo';

    /**
     * Contains a string signifying the name of the addTitle field in the mod_simpleemailform.xml file.
     *
     * @var string
     * @since 2.0.0
     */
    protected $addTitleName = '_addTitle';

    /**
     * DEPRECATED - Contained a string signifying the value of the copyme field in the submitted form.
     *
     * @deprecated 2.1.0
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailCopyme = 'N';

    /**
     * DEPRECATED - Contained a string signifying the value of the copyme field's label in the rendered form.
     *
     * @deprecated 2.1.0
     *
     * @var string
     * @since 2.0.0
     */
    protected $emailCopymeLabel = '';

    /**
     * Contains a string signifying the value of Joomla's language tag.
     *
     * @var string
     * @since 2.0.0
     */
    protected $lang = '';

    /**
     * Contains an array of strings parsed from the appropriate language file.
     *
     * @var array
     * @since 2.0.0
     */
    protected $transLang = array();

    /**
     * Contains a string of allowed HTML tags in the email body.
     *
     * @var string
     * @since 2.0.0
     */
    protected $allowedHtmlTags = '<p><a><strong><span><em>
                                    <table><tbody><tr><td>
                                    <address><hr><img><ul><ol><li>
                                    <h1><h2><h3><h4><h5><h6>';

    /**
     * Contains an array of strings signifying the names of the form's upload fields.
     *
     * @var array
     * @since 2.0.0
     */
    protected $uploadName = array();

    /**
     * Contains a string signifying the value of the form's upload field label.
     *
     * @var string
     * @since 2.0.0
     */
    protected $uploadLabel = '';

    /**
     * Contains a string signifying the value of allowed uploaded file suffixes.
     *
     * @var string
     * @since 2.0.0
     */
    protected $uploadAllowedFiles = '';

    /**
     * Contains an array of the exploded string contained in the $uploadAllowedFiles property.
     *
     * @var array
     * @since 2.0.0
     */
    protected $uploadAllowedFilesArray = array();

    /**
     * Contains an integer signifying the form instance number.
     *
     * @var int
     * @since 2.0.0
     */
    protected $formInstance;

    /**
     * Contains a string signifying the value of the form's HTML anchor.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formAnchor;

    /**
     * Contains a boolean signifying that rendering is on or off.
     *
     * @var bool
     * @since 2.0.0
     */
    protected $formRendering = true;

    /**
     * Contains a string signifying that test mode is on or off.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formTestMode = 'N';

    /**
     * Contains an array of strings signifying the values of the form's active fields.
     *
     * @var array
     * @since 2.0.0
     */
    protected $formActiveElements;

    /**
     * Contains an integer signifying the number of active fields.
     *
     * @var int
     * @since 2.0.0
     */
    protected $formActiveElementsCount;

    /**
     * Contains a string signifying the value of Simple Email Form's CSS class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formCssClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS Table class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formTableClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS TR class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formTrClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS TH class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formThClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS Space class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formSpaceClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS TD class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formTdClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS Input class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formInputClass;

    /**
     * Contains a string signifying the name of Simple Email Form's CSS Captcha class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formCaptchaClass;

    /**
     * Contains a string signifying the value of Simple Email Form's CSS Col2space class parameter.
     *
     * @var int
     * @since 2.0.0
     */
    protected $formCol2Space;

    /**
     * Contains a string signifying the value of Simple Email Form's CSS labelAlign class parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $formLabelAlign;

    /**
     * Contains a string signifying the value of the success message color.
     *
     * @var string
     * @since 2.0.0
     */
    protected $successColour = 'green';

    /**
     * Contains a string signifying the value of the error message color.
     *
     * @var string
     * @since 2.0.0
     */
    protected $errorColour = 'red';

    /**
     * Contains a string signifying the value of Simple Email Form's redirectURL parameter.
     *
     * @var string
     * @since 2.0.0
     */
    protected $redirectedToURL = '';

    /**
     * Contains a string signifying the value of Simple Email Form's flash messaging.
     *
     * @var string
     * @since 2.0.0
     */
    public $msg = '';

    /**
     * Contains a string signifying the value of Simple Email Form's rendered HTML output.
     *
     * @var string
     * @since 2.0.0
     */
    protected $output = '';

    /**
     * sefv2modsimpleemailform constructor.
     *
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

        $this->errorColour = $this->paramsArray[$this->formPrefixName . $this->formErrorColourName];
        $this->successColour = $this->paramsArray[$this->formPrefixName . $this->formSuccessColourName];

        // Check if automatic rendering has been turned off (user defined).
        if ($this->paramsArray[$this->formPrefixName . $this->formRenderingOverrideName] === 'Y') {
            $this->formRendering = false;
        }

        // Set the Joomla Registry's ($this->params and $this->paramsArray) property/key names.
        $this->formInstance = $this->paramsArray[$this->formPrefixName . $this->formInstanceName];

        $this->formAnchor =
            (strlen($this->paramsArray[$this->formPrefixName . $this->formAnchorName]) > 1
            && strpos($this->paramsArray[$this->formPrefixName . $this->formAnchorName], '#') === 0)
            ? ($this->paramsArray[$this->formPrefixName . $this->formAnchorName])
            : '#';

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
            . 'language'
            . DIRECTORY_SEPARATOR
            . $this->lang
            . DIRECTORY_SEPARATOR
            . $this->lang
            . '.mod_simpleemailform.ini';

        if ($this->paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N') {
            if (file_exists($langFile)) {
                $this->transLang = parse_ini_file($langFile);
            } else {
                $langFile = MOD_SIMPLEEMAILFORM_DIR
                    . DIRECTORY_SEPARATOR
                    . 'language'
                    . DIRECTORY_SEPARATOR
                    . 'en-GB'
                    . DIRECTORY_SEPARATOR
                    . 'en-GB.mod_simpleemailform.ini';

                $this->transLang = parse_ini_file($langFile);
            }
        }

        if (empty($this->paramsArray[$this->formPrefixName . $this->emailToName])) {
            $this->msg .=
                $this->paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                "<p style=\"color:{$this->errorColour}\">" .
                $this->getTransLang('MOD_SIMPLEEMAILFORM_EMAIL_INVALID') .
                "</p>" :
                "<p style=\"color:{$this->errorColour}\">" .
                JText::_('MOD_SIMPLEEMAILFORM_EMAIL_INVALID') .
                "</p>";

            $this->formRendering = false;
        }

        // Determine the active fields that must be included in the form.
        $this->determineActiveElements($this->paramsArray);

        // Get the XML configuration for the active fields.
        $this->xmlConfig = $this->createXMLConfig($this->paramsArray);

        // Load the XML configuration into the JForm object.
        $this->load($this->xmlConfig);

        // Set default values of all of the form's active elements.
        $this->setDefaultValuesOfActiveElements(
            $this->formActiveElements,
            $this->formActiveElementsCount,
            $this->paramsArray,
            $this->jForm
        );

        // Store test mode status.
        $this->formTestMode = $this->paramsArray[$this->formPrefixName . $this->formTestModeName];

        // Check if $_POST was set.
        if ($this->jInput->getMethod() === 'POST'
            && isset($_POST[$this->formSubmitButtonName . '_' . $this->formInstance])) {
            // 2012-02-15 DB: Override unwanted error messages originating from JMail.
            ob_start();

            // CAUTION : $formDataRaw is not validated and is unfiltered and unsanitized!
            $formDataRaw = $this->jInput->post->getArray(array(), null, 'raw', true);

            // Check for file uploads
            $files = $this->jInput->files->getArray(array(), null, 'raw', true);

            // Validate, filter, sanitize and process the form data.
            $formProcessingResult = $this->processFormData($formDataRaw, $files, $this->paramsArray, $this->emailMsg);

            // Reset the form before sending it back to the view.
            $this->reset();

            if ($formProcessingResult) {
                // Redirect if the redirectURL parameter is set.
                $redirectURL = $this->paramsArray[$this->formPrefixName . $this->formRedirectURLName];

                if ($redirectURL !== '') {
                    $this->redirectedToURL = $redirectURL;
                    header('Location: ' . $this->redirectedToURL);
                    ob_end_clean();
                    return;
                }

                // If not redirected, send a success message to the view.
                $this->msg .=
                    $this->paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                    "<p style=\"color:{$this->successColour}\">" .
                    "{$this->getTransLang('MOD_SIMPLEEMAILFORM_FORM_SUCCESS')}" .
                    "</p>" :
                        "<p style=\"color:{$this->successColour}\">" .
                        JText::_('MOD_SIMPLEEMAILFORM_FORM_SUCCESS') .
                        "</p>";
            }

            ob_end_clean();
        } elseif ($this->jInput->getMethod() === 'POST'
                  && isset($_POST[$this->formResetButtonName . '_' . $this->formInstance])) {
            $this->reset();
        }
    }

    /**
     * Method to bind data to the form.
     *
     * @param mixed $data
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function bind($data)
    {
        return $this->jForm->bind($data);
    }

    /**
     * Creates the XML configuration string.
     *
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
                    $item = strtolower(trim($item));
                    $item = (strpos($item, '.') === 0) ? '.' . trim(substr($item, 1)) : '.' . $item;
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
     * Decorates the HTML input fields and their corresponding labels (if any).
     *
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

        // If no label, field is hidden or field is of types "submit" or "reset".
        if (!isset($label) || preg_match('/type="submit|reset"/is', $input) === 1) {
            // Submit and reset buttons.
            $decoratedInput .= $tr
                . $td
                . $tdClose
                . '<td width="' . $this->formCol2Space  . '">&nbsp;</td>'
                . $td
                . $input
                . $tdClose
                . $trClose
                . "\n";
        } else {
            $label = (string) $label;

            $matchesInput = array();
            $matchesLabel = array();
            $matchesLabelTag = array();

            $resultInput = preg_match_all('/<input.+?>/is', $input, $matchesInput);

            if ($resultInput > 1 || strpos($input, 'type="checkbox"') !== false) {
                $multiInput = '';

                $lookBehind = $this->formPrefixName . $this->fieldPrefixName;

                $pattern = "/(?<=$lookBehind)[0-9]{1}(?=_[0-9])/is";

                $fieldNumberArray = array();

                preg_match($pattern, $input, $fieldNumberArray);

                $ckRfmt = (!empty($fieldNumberArray))
                    ? $this->paramsArray[
                        $this->formPrefixName
                        . $this->fieldPrefixName
                        . $fieldNumberArray[0]
                        . $this->fieldCkrfmtName
                    ]
                    : 'H';

                $ckRpos = (!empty($fieldNumberArray))
                    ? $this->paramsArray[
                        $this->formPrefixName
                        . $this->fieldPrefixName
                        . $fieldNumberArray[0]
                        . $this->fieldCkrposName
                    ]
                    : 'B';

                if (strpos($input, 'type="checkbox"') !== false) {
                    preg_match_all('/(?<=>).{1,40}(?=<\/label>)/is', $input, $matchesLabel);
                } else {
                    preg_match_all('/(?<=\s>).{1,100}(?=<\/label>)/is', $input, $matchesLabel);
                }

                $labelTagCount = preg_match_all('/<label.+?>/is', $input, $matchesLabelTag);

                $multiInputFormat = '';

                if ($labelTagCount > 0) {
                    for ($i = 0; $i < $resultInput; $i++) {
                        if ($i === 0 && $ckRfmt !== 'C') {
                            $multiInput = '<table>';
                        }

                        if ($ckRfmt === 'H') {
                            $multiInputFormat = $td
                                . '%BEFORE%'
                                . $tdClose
                                . $td
                                . '%AFTER%'
                                . $tdClose
                                . $td
                                . '&nbsp;&nbsp;'
                                . $tdClose;
                        } elseif ($ckRfmt === 'V') {
                            $multiInputFormat = $tr
                                . $td
                                . '%BEFORE%'
                                . $tdClose
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

                        if ($i === $resultInput - 1 && $ckRfmt !== 'C') {
                            $multiInput .= '</table>';
                            $multiInput .= "\n";
                        }
                    }

                    $input = $multiInput;
                }
            }

            $th = "<th align=\"{$this->formLabelAlign}\" 
                        style=\"text-align:{$this->formLabelAlign};\" 
                        class=\"{$this->formThClass}\">
                    $label
                </th>";

            $decoratedInput .= $tr
                . $th
                . '<td width="' . $this->formCol2Space  . '">&nbsp;</td>'
                . $td
                . $input
                . $tdClose
                . $trClose
                . "\n";
        }

        return $decoratedInput;
    }

    /**
     * Determines which of the Simple Email Form fields are active.
     *
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
     * Method to filter the form data.
     *
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
     * Getter for the form data
     *
     * @param null
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function getData()
    {
        return $this->jForm->getData();
    }

    /**
     * Return all errors, if any.
     *
     * @param null
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function getErrors()
    {
        return $this->jForm->getErrors();
    }

    /**
     * Method to get a form field represented as a JFormField object.
     *
     * @param string $name
     * @param null $group
     * @param null $value
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function getField($name, $group = null, $value = null)
    {
        $name = (string) $name;

        return $this->jForm->getField($name, $group, $value);
    }

    /**
     * Method to get an array of JFormField objects in a given fieldset by name.
     * If no name is given then all fields are returned.
     *
     * @param null $set
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function getFieldset($set = null)
    {
        return $this->jForm->getFieldset($set);
    }

    /**
     * Gets the value of the formAnchor property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getFormAnchor()
    {
        return $this->formAnchor;
    }

    /**
     * Gets the value of the formInstance property.
     *
     * @param null
     *
     * @return int
     *
     * @since 2.1.0
     */
    public function getFormInstance()
    {
        return $this->formInstance;
    }

    /**
     * Gets the value of the formRendering property.
     *
     * @param null
     *
     * @return bool
     *
     * @since 2.1.0
     */
    public function getFormRendering()
    {
        return $this->formRendering;
    }

    /**
     * Gets the value of the formResetButtonName property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getFormResetButtonName()
    {
        return $this->formResetButtonName;
    }

    /**
     * Gets the value of the formSubmitButtonName property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getFormSubmitButtonName()
    {
        return $this->formSubmitButtonName;
    }

    /**
     * Gets the value of the msg property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Gets the value of the stringOverride index in the Joomla Registry.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.2.0
     */
    public function getStringOverride()
    {
        return $this->paramsArray[$this->formPrefixName . $this->formStringOverrideName];
    }

    /**
     * Gets the value of the transLang property at the given index.
     *
     * @param string
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getTransLang($index)
    {
        $index = (string) $index;

        return $this->transLang[$index];
    }

    /**
     * Returns a field's XML configuration string.
     *
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
                } else {
                    $type .= 'checkboxes';
                }

                $multiValue = '';
                $valueArray = explode(',', $value);

                if (count($valueArray) > 1) {
                    foreach ($valueArray as $multiValues) {
                        $valuesToInsert = explode('=', $multiValues);
                        if (count($valuesToInsert) > 1) {
                            $valuesToInsert = array_map('trim', $valuesToInsert);
                            $multiValue .= "<option value=\"$valuesToInsert[0]\">$valuesToInsert[1]</option>";
                        }
                    }
                } else {
                    if ($from === 'C') {
                        $valuesToInsert = explode('=', $valueArray[0]);
                        $valuesToInsert = array_map('trim', $valuesToInsert);
                        if (count($valuesToInsert) > 1) {
                            $multiValue .= "<option value=\"$valuesToInsert[0]\">$valuesToInsert[1]</option>";
                        } else {
                            $type = 'checkbox';
                        }
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
     * Returns an upload field's XML configuration string.
     *
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

        $description = $this->paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
            $this->getTransLang('MOD_SIMPLEEMAILFORM_ATTACHMENT') :
            JText::_('MOD_SIMPLEEMAILFORM_ATTACHMENT');

        $uploadField = '';

        $uploadField .= "<field 
                            name=\"$uploadName\"
                            type=\"file\"
                            label=\"$uploadLabel\"
                            description=\"$description\"
                            size=\"10\"
                            accept=\"$uploadAllowedFiles\" />";

        return $uploadField;
    }

    /**
     * Returns a CAPTCHA field's XML configuration string.
     *
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

        $label = $this->paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
            $this->getTransLang('MOD_SIMPLEEMAILFORM_CAPTCHA_PLEASE_HELP') :
            JText::_('MOD_SIMPLEEMAILFORM_CAPTCHA_PLEASE_HELP');

        $description = $this->paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
            $this->getTransLang('MOD_SIMPLEEMAILFORM_CAPTCHA_PLEASE_ENTER') :
            JText::_('MOD_SIMPLEEMAILFORM_CAPTCHA_PLEASE_ENTER');

        $captchaField = '';

        $captchaField .= "<field
                            name=\"$name\"
                            type=\"captcha\"
                            validate=\"captcha\"
                            namespace=\"$namespace\"
                            label=\"$label\"
                            description=\"$description\">
                           </field>";

        return $captchaField;
    }

    /**
     * Method to load the form description from an XML string or object.
     *
     * @param string $xmlConfigString
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function load($xmlConfigString)
    {
        return $this->jForm->load($xmlConfigString);
    }

    /**
     * Processes the user's submitted data.
     *
     * @param array $formDataRaw
     * @param array $files
     * @param array $paramsArray
     * @param sefv2simpleemailformemailmsg $emailMsg
     *
     * @return bool
     *
     * @since 2.0.0
     */
    protected function processFormData(
        array $formDataRaw,
        array $files,
        array $paramsArray,
        sefv2simpleemailformemailmsg $emailMsg
    ) {

        // Check for CSRF token match.
        if (!($this->jSession->checkToken())) {
            $this->msg .= $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                "<p style=\"color:{$this->errorColour}\">" .
                "\"Invalid Token\" - {$this->getTransLang('MOD_SIMPLEEMAILFORM_FORM_UNABLE')}" .
                "</p>" :
                "<p style=\"color:{$this->errorColour}\">" .
                "\"Invalid Token\" - " . JText::_('MOD_SIMPLEEMAILFORM_FORM_UNABLE') .
                "</p>";

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

                $this->msg .= $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                    "<p style=\"color:{$this->errorColour}\">" .
                    "\"$errorMsg\" - {$this->getTransLang('MOD_SIMPLEEMAILFORM_FORM_UNABLE')}" .
                    "</p>" :
                    "<p style=\"color:{$this->errorColour}\">" .
                    "\"$errorMsg\" - " . JText::_('MOD_SIMPLEEMAILFORM_FORM_UNABLE') .
                    "</p>";
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
                    $this->jFile,
                    $paramsArray
                );
            } elseif (!empty($files[$this->uploadName[$i]]['tmp_name'])
                && $files[$this->uploadName[$i]]['error'] !== 0) {
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
                $this->msg .= $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                    "<p style=\"color:{$this->errorColour}\">" .
                    "{$this->getTransLang('MOD_SIMPLEEMAILFORM_UPLOAD_ERROR')}" .
                    "</p>" :
                    "<p style=\"color:{$this->errorColour}\">" .
                    JText::_('MOD_SIMPLEEMAILFORM_UPLOAD_ERROR') .
                    "</p>";

                return false;
            }
        }

        $sendFormResult = $this->sendFormData($formDataClean, $paramsArray, $emailMsg, $this->jMail);

        if (!$sendFormResult) {
            return false;
        }

        return true;
    }

    /**
     * Method to remove a field from the form definition.
     *
     * @param string $name
     * @param null $group
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function removeField($name, $group = null)
    {
        $name = (string) $name;

        return $this->jForm->removeField($name, $group);
    }

    /**
     * Render the Simple Email Form.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.0.0
     */
    public function render()
    {
        if (!$this->getFormRendering()) {
            return;
        }

        $submitValue = $this->getStringOverride() === 'N' ?
            $this->getTransLang('MOD_SIMPLEEMAILFORM_BUTTON_SUBMIT') :
            JText::_('MOD_SIMPLEEMAILFORM_BUTTON_SUBMIT');

        $submitTitle = $this->getStringOverride() === 'N' ?
            $this->getTransLang('MOD_SIMPLEEMAILFORM_CLICK_SUBMIT') :
            JText::_('MOD_SIMPLEEMAILFORM_CLICK_SUBMIT');

        $resetValue = $this->getStringOverride() === 'N' ?
            $this->getTransLang('MOD_SIMPLEEMAILFORM_BUTTON_RESET') :
            JText::_('MOD_SIMPLEEMAILFORM_BUTTON_RESET');

        // Present the Email Form.
        $this->output .= !empty($this->formCssClass)
            ? "<div class=\"" . $this->formCssClass . "\">\n"
            : '';

        // 2012-04-20 DB: Added anchor (default anchor = #).
        $this->output .=
            '<a name="'
            . substr($this->getFormAnchor(), 1)
            . '">&nbsp;</a>'
            . "\n";

        $this->output .= "<form method=\"post\" "
            . "action=\"" . $this->getFormAnchor() . "\" "
            . "name=\"_SimpleEmailForm_" . $this->getFormInstance() . "\" "
            . "id=\"_SimpleEmailForm_" . $this->getFormInstance() . "\" "
            . "enctype=\"multipart/form-data\">\n";

        $this->output .= "<table class=\"" . $this->formTableClass . "\">\n";

        $this->output .= "\t<tbody>\n";

        $fieldSets = $this->getFieldset('main');

        $submitandReset = "<br /><input
                                class=\"{$this->formInputClass}\"
                                name=\"{$this->getFormSubmitButtonName()}_{$this->getFormInstance()}\"
                                id=\"{$this->getFormSubmitButtonName()}_{$this->getFormInstance()}\"
                                value=\"$submitValue\"
                                title=\"$submitTitle\"
                                type=\"submit\">\n";

        $submitandReset .= "<input
                                class=\"{$this->formInputClass}\"
                                name=\"{$this->getFormResetButtonName()}_{$this->getFormInstance()}\"
                                id=\"{$this->getFormResetButtonName()}_{$this->getFormInstance()}\"
                                value=\"$resetValue\"
                                title=\"\"
                                type=\"reset\">\n";

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

        $this->output .= $this->decorateInput($submitandReset);

        $this->output .= "\t</tbody>\n";

        $this->output .= "</table>\n";

        $this->output .= "</form>\n";

        # FLS: Added missing closing div tag (HTML validation error).  Thanks to Thonal for this fix!
        $this->output .= "</div>\n";

        if ($this->formTestMode === 'Y') {
            $this->output = htmlspecialchars($this->output);
            return '<pre>' . htmlspecialchars($this->testDump($this)) . '</pre>';
        }

        $this->output .= $this->getMsg();

        return $this->output;
    }

    /**
     * Method to reset the form data store and optionally the form XML definition.
     *
     * @param bool $xml
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function reset($xml = false)
    {
        return $this->jForm->reset($xml);
    }

    /**
     * Sets the default values of the form's active elements.
     *
     * @param array $formActiveElements
     * @param $formActiveElementsCount
     * @param array $paramsArray
     * @param Jform $jForm
     *
     * @since 2.0.0
     */
    protected function setDefaultValuesOfActiveElements(
        array $formActiveElements,
        $formActiveElementsCount,
        array $paramsArray,
        \Jform $jForm
    ) {

        $formActiveElementsCount = (int) $formActiveElementsCount;

        for ($i = 1; $i <= $formActiveElementsCount; $i++) {
            $index = $i - 1;

            $active = $paramsArray[$formActiveElements[$index] . $this->fieldActiveName];

            $name = $formActiveElements[$index]
                . '_'
                . $this->formInstance;

            $valueKey = $formActiveElements[$index] . $this->fieldValueName;

            $value = $paramsArray[$valueKey];

            $jForm->setValue($name, '', $value);
        }
    }

    /**
     * Sends an email with the user's submitted data.
     *
     * @param array $formDataClean
     * @param array $paramsArray
     * @param sefv2simpleemailformemailmsg $emailMsg
     * @param JMail $jMail
     *
     * @return bool
     *
     * @since 2.0.0
     */
    protected function sendFormData(
        array $formDataClean,
        array $paramsArray,
        sefv2simpleemailformemailmsg $emailMsg,
        \JMail $jMail
    ) {

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
            // 2016-04-18 DB: ReplyTo no longer needs to be an array if Joomla >= 3.0.
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
            $emailMsg->copyMe =
                (isset($formDataClean[$this->formPrefixName . $this->fieldCopymeName . '_' . $this->formInstance]))
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

                // 2017-12-15 AC: Added the option of changing the copyme email's body content with a predefined value.
                if (!empty($paramsArray[$this->formPrefixName . $this->emailCopymeContentName])) {
                    $emailMsg->body = '';
                    $emailMsg->body = $paramsArray[$this->formPrefixName . $this->emailCopymeContentName];
                    $jMail->setBody($emailMsg->body);
                }

                if (!$sent = $jMail->send()) {
                    return false;
                }
            }
        } catch (Exception $e) {
            $this->msg .= $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                '<p style="color:' . $this->errorColour . '">'
                . $this->getTransLang('MOD_SIMPLEEMAILFORM_ERROR') . ' : Mail Server</p>' :
                '<p style="color:' . $this->errorColour . '">'
                . JText::_('MOD_SIMPLEEMAILFORM_ERROR') . ' : Mail Server</p>';

            $this->msg .= $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                '<p style="color:' . $this->errorColour . '">'
                . $this->getTransLang('MOD_SIMPLEEMAILFORM_EMAIL_INVALID') . '</p>' :
                '<p style="color:' . $this->errorColour . '">'
                . JText::_('MOD_SIMPLEEMAILFORM_EMAIL_INVALID') . '</p>';
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
     * Formats the data obtained in test mode.
     *
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
     * Prepares the uploaded files to be attached to the email.
     *
     * @param string fileName
     * @param string $fileTmpName
     * @param JFile $jFile
     * @param array $paramsArray
     *
     * @return bool
     *
     * @since 2.2.0
     */
    protected function uploadFile($fileName, $fileTmpName, \JFile $jFile, $paramsArray)
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

                $this->msg .= $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                    "<p style=\"color:{$this->successColour}\">" .
                    "{$this->getTransLang('MOD_SIMPLEEMAILFORM_UPLOAD_SUCCESS')}" .
                    "</p>" :
                    "<p style=\"color:{$this->successColour}\">" .
                    JText::_('MOD_SIMPLEEMAILFORM_UPLOAD_SUCCESS') .
                    "</p>";

                return true;
            } else {
                $this->msg = $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                    "<p style=\"color:{$this->errorColour}\">" .
                    "{$this->getTransLang('MOD_SIMPLEEMAILFORM_UPLOAD_FAILURE')}" .
                    "</p>" :
                    "<p style=\"color:{$this->errorColour}\">" .
                    JText::_('MOD_SIMPLEEMAILFORM_UPLOAD_FAILURE') .
                    "</p>";

                return false;
            }
        } else {
            $this->msg = $paramsArray[$this->formPrefixName . $this->formStringOverrideName] === 'N' ?
                "<p style=\"color:{$this->errorColour}\">" .
                "{$this->getTransLang('MOD_SIMPLEEMAILFORM_DISALLOWED_FILENAME')}" .
                "</p>" :
                "<p style=\"color:{$this->errorColour}\">" .
                JText::_('MOD_SIMPLEEMAILFORM_DISALLOWED_FILENAME') .
                "</p>";

            return false;
        }
    }

    /**
     * Method to validate form data.
     *
     * @param array $data
     * @param null $group
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function validate(array $data, $group = null)
    {
        return $this->jForm->validate($data, $group);
    }
}
