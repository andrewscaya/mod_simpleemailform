--TEST--
Example test emulating a file upload
--POST_RAW--
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryfywL8UCjFtqUBTQn

------WebKitFormBoundaryfywL8UCjFtqUBTQn
Content-Disposition: form-data; name="mod_simpleemailform_upload_1_1"
Content-Type: text/plain

This is a test

------WebKitFormBoundaryfywL8UCjFtqUBTQn
Content-Disposition: form-data; name="submit"

Upload
------WebKitFormBoundaryfywL8UCjFtqUBTQn--
--FILE--
<?php
//ini_set('display_errors', 0);
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'helper.php';

$paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'serializedParamsObject'); 
$params = unserialize($paramsSerialized);

$message = '';

$obj = new modSimpleEmailForm($params);

$testResult = $obj->uploadAttachment('', '', 'RED', 'GREEN', $message, 1);;

var_dump($testResult);
?>
--EXPECT--
NULL