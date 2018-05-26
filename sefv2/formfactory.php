<?php

/**
 * formfactory.php
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

/**
 * The Simple Email Form Factory.
 *
 * @package Simple Email Form
 *
 * @since 2.0.0
 */
class sefv2formfactory implements sefv2formfactoryinterface
{

    /**
     * Creates an sefv2modsimpleemailform object.
     *
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
