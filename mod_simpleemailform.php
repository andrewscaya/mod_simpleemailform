<?php

/**
 * mod_simpleemailform.php
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
 * @since 1.0.0
 * @version 2.3.0
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// 2010-04-28 added DB
jimport('joomla.filesystem.file');

// current directory constant
defined('MOD_SIMPLEEMAILFORM_DIR')
    || define('MOD_SIMPLEEMAILFORM_DIR', dirname(__FILE__));

// Joomla autoloading
\JLoader::discover('sef', MOD_SIMPLEEMAILFORM_DIR . DIRECTORY_SEPARATOR . 'sef', true, true);
\JLoader::discover('sefv2', MOD_SIMPLEEMAILFORM_DIR . DIRECTORY_SEPARATOR . 'sefv2', true, true);

// Get the module helper (must be a helperfactoryinterface).
$sefv2helper = \sefv2helper::getInstance();

// Build the form and render the form's output in order to send it to the view.
$form = $sefv2helper->buildForm($params);

if ($form instanceof sefv2formrendererinterface) {
    $view = $form->render();
}

require(JModuleHelper::getLayoutPath('mod_simpleemailform'));
