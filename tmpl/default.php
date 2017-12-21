<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php

$defaultCustomFile = 'default_custom.php';

if (!$form->getFormRendering() && file_exists($defaultCustomFile)) {
    $view = require_once "$defaultCustomFile";
}
elseif (!$form->getFormRendering() && !file_exists($defaultCustomFile)) {
    $view = "Custom default view file /tmpl/$defaultCustomFile not found.";
}

echo $view;
