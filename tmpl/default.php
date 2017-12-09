<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php

if(!$form->getFormRendering()) {

    $view = require_once 'default_custom.php';

}

echo $view;
