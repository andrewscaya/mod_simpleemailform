<?php
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php

$defaultCustomFile = __DIR__ . DIRECTORY_SEPARATOR . 'default_custom.php';

if (!$form->getFormRendering() && file_exists($defaultCustomFile)) {
    $view = require_once "$defaultCustomFile";
} elseif (!$form->getFormRendering() && !file_exists($defaultCustomFile)) {
    $view = "Custom default view file $defaultCustomFile not found.";
}

echo $view;
