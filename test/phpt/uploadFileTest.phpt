--TEST--
Example test emulating a file upload
--POST_RAW--
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryfywL8UCjFtqUBTQn

------WebKitFormBoundaryfywL8UCjFtqUBTQn
Content-Disposition: form-data; name="mod_simpleemailform_upload_1_1"; filename="example.txt"
Content-Type: text/plain

This is a test

------WebKitFormBoundaryfywL8UCjFtqUBTQn
Content-Disposition: form-data; name="submit"

Upload
------WebKitFormBoundaryfywL8UCjFtqUBTQn--
--FILE--
<?php
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'serializedParamsObject'); 
$params = unserialize($paramsSerialized);

$message = '';

$obj = new \SefModsimpleemailform($params);

$testResult = $obj->uploadAttachment('/tmp', '', 'RED', 'GREEN', $message, 1);;

var_dump($testResult);
?>
--EXPECT--
string(11) "example.txt"