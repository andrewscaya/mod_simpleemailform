<?php

interface sefv2formfactoryinterface
{
    /**
     * @param \Joomla\Registry\Registry $params
     *
     * @return sefv2modsimpleemailform object
     *
     * @since 2.0.0
     */
    public function createSefv2FormObject(\Joomla\Registry\Registry $params);
}
