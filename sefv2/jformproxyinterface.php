<?php

/**
 * jformproxyinterface.php
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
 * The Simple Email Form JForm Proxy Interface.
 *
 * @package Simple Email Form
 *
 * @since 2.0.0
 */
interface sefv2jformproxyinterface
{
    /**
     * Method to bind data to the form.
     *
     * @param mixed $data
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function bind($data);

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
    public function filter(array $data, $group = null);

    /**
     * Getter for the form data
     *
     * @param null
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function getData();

    /**
     * Return all errors, if any.
     *
     * @param null
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function getErrors();

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
    public function getField($name, $group = null, $value = null);

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
    public function getFieldset($set = null);

    /**
     * Method to load the form description from an XML string or object.
     *
     * @param string $xmlConfigString
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function load($xmlConfigString);

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
    public function removeField($name, $group = null);

    /**
     * Method to reset the form data store and optionally the form XML definition.
     *
     * @param bool $xml
     *
     * @return mixed
     *
     * @since 2.0.0
     */
    public function reset($xml = false);

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
    public function validate(array $data, $group = null);
}
