<?php

interface sefv2jformproxyinterface
{
    public function bind($data);

    public function filter(array $data, $group = null);

    public function getData();

    public function getField($name, $group = null, $value = null);

    public function removeField($name, $group = null);

    public function getErrors();

    public function getFieldset($set);

    public function load($xmlConfigString);

    public function reset($xml = false);

    public function validate(array $data, $group = null);
}
