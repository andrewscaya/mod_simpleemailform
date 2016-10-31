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
        $jForm = \JForm::getInstance();

        $jMail = \JMail::getInstance();

        $jDocument = \JFactory::getDocument();

        return new sefv2modsimpleemailform(
            $jForm,
            $jMail,
            $jDocument,
            $params
        );
    }
}
