<?php

interface sefv2jformproxyinterface
{
    public function bind();

    public function filter();

    public function getData();

    public function getField();

    public function addField();

    public function removeField();

    public function getFieldset();

    public function load();

    public function reset();

    public function validate();
}
