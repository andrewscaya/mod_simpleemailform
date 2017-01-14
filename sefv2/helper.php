<?php

/**
 * helper.php
 *
 * Copyright 2010 - 2017 D. Bierer <doug@unlikelysource.com>
 * Version 2.0.0
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
 * @copyright  Copyright 2010 - 2017 D. Bierer <doug@unlikelysource.com>
 * @link       http://joomla.unlikelysource.org/
 * @license    GNU/GPLv2, see above
 */

class sefv2helper implements sefv2helperfactoryinterface
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
        return;
    }

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

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
