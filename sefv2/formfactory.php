<?php

class sefv2formfactory implements sefv2formfactoryinterface
{
    /**
     * @param \Joomla\Registry\Registry $params
     *
     * @return sefv2modsimpleemailform object
     *
     * @since 2.0.0
     */
    public function createSefv2FormObject(\Joomla\Registry\Registry $params)
    {
        $jForm = new \JForm('simpleemailform');

        $jMail = JFactory::getMailer();

        $emailMsg = new sefv2simpleemailformemailmsg();

        $jDocument = \JFactory::getDocument();

        $jLanguage = \JFactory::getLanguage();

        $jInput = \JFactory::getApplication()->input;

        $jTableExtension = \JTable::getInstance('extension');

        $jTableModule = \JTable::getInstance('module');

        $jModuleHelperResult = \JModuleHelper::getModule('mod_simpleemailform');

        $jSession = \JFactory::getSession();

        $jFile = new \JFile();

        return new sefv2modsimpleemailform(
            $jForm,
            $jMail,
            $emailMsg,
            $jDocument,
            $jLanguage,
            $params,
            $jInput,
            $jTableExtension,
            $jTableModule,
            $jModuleHelperResult,
            $jSession,
            $jFile
        );
    }
}
