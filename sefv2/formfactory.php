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
        $jMail = JFactory::getMailer();

        $emailMsg = new sefv2simpleemailformemailmsg();

        $jDocument = \JFactory::getDocument();

        $jLanguage = \JFactory::getLanguage();

        $jInput = \JFactory::getApplication()->input;

        return new sefv2modsimpleemailform(
            new \JForm('simpleemailform'),
            $jMail,
            $emailMsg,
            $jDocument,
            $jLanguage,
            $params,
            $jInput
        );
    }
}
