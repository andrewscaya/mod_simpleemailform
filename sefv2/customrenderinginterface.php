<?php

/**
 * customrenderinginterface.php
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
 * @since 2.1.0
 */

/**
 * The Simple Email Form Factory Interface.
 *
 * @package Simple Email Form
 *
 * @since 2.1.0
 */
interface sefv2customrenderinginterface
{

    /**
     * Gets the value of the formAnchor property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getFormAnchor();

    /**
     * Gets the value of the formInstance property.
     *
     * @param null
     *
     * @return int
     *
     * @since 2.1.0
     */
    public function getFormInstance();

    /**
     * Gets the value of the formRendering property.
     *
     * @param null
     *
     * @return bool
     *
     * @since 2.1.0
     */
    public function getFormRendering();

    /**
     * Gets the value of the formResetButtonName property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getFormResetButtonName();

    /**
     * Gets the value of the formSubmitButtonName property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getFormSubmitButtonName();

    /**
     * Gets the value of the msg property.
     *
     * @param null
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getMsg();

    /**
     * Gets the value of the transLang property at the given index.
     *
     * @param string
     *
     * @return string
     *
     * @since 2.1.0
     */
    public function getTransLang($index);
}
