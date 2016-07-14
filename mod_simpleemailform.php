<?php
/**
        mod_simpleemailform.php

        Copyright 2010 - 2016 D. Bierer <doug@unlikelysource.com>
        Version 1.8.8

        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation; either version 2 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
        MA 02110-1301, USA.

        * @package    mod_simpleemailform
        * @subpackage Modules
        * @link       http://joomla.unlikelysource.com/
        * @license    GNU/GPL, see above

        2014-10-31 DB:
        * Added the Norwegian language thanks to    Eugen Landeide <eugen.landeide@online.no>
        *
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// 2010-04-28 added DB
jimport('joomla.filesystem.file');

// current directory constant
defined('MOD_SIMPLEEMAILFORM_DIR')
    || define('MOD_SIMPLEEMAILFORM_DIR', dirname(__FILE__));

// Include the syndicate functions only once
require_once(MOD_SIMPLEEMAILFORM_DIR . DIRECTORY_SEPARATOR . 'helper.php');

$form = new modSimpleEmailForm($params);
$view = $form->main();
require(JModuleHelper::getLayoutPath('mod_simpleemailform'));
