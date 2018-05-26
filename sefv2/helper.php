<?php

/**
 * helper.php
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
 * The Simple Email Form Helper.
 *
 * @package Simple Email Form
 *
 * @since 2.0.0
 */
class sefv2helper implements sefv2helperfactoryinterface
{
    /**
     * Contains an instance of the sefv2helper object.
     *
     * @var null|sefv2helper
     * @since 2.0.0
     */
    private static $instance = null;

    /**
     * sefv2helper constructor.
     *
     * @since 2.0.0
     */
    private function __construct()
    {
    }

    /**
     * Prevents sefv2helper from being cloned.
     *
     * @since 2.0.0
     */
    private function __clone()
    {
        return;
    }

    /**
     * Returns a singleton instance of sefv2helper.
     *
     * @param null
     *
     * @return sefv2helper
     *
     * @since version
     */
    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Builds the Simple Email Form.
     *
     * @param \Joomla\Registry\Registry $params
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function buildForm(\Joomla\Registry\Registry $params)
    {
        if ($params->get('mod_simpleemailform_formType') === 'jform') {
            $formFactory = new sefv2formfactory();
            return $formFactory->createSefv2FormObject($params);
        } else {
            return new sefmodsimpleemailform($params);
        }
    }
}
