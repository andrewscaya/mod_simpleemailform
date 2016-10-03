<?php

ini_set('display_errors', 1);

define('_JEXEC', 1);

define('JPATH_ROOT', __DIR__);

define('JPATH_PLATFORM', __DIR__ . DIRECTORY_SEPARATOR . 'lib');

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

\JLoader::registerPrefix('Sef', __DIR__ . DIRECTORY_SEPARATOR . 'sef');

\JLoader::setup();

$refl = new ReflectionClass(new SefModsimpleemailform);

//var_dump($refl);
