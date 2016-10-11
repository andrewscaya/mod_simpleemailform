<?php
/*
        mod_simpleEmailForm.php

        Copyright 2010 - 2016 D. Bierer <doug@unlikelysource.com>
        Version 1.8.9

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
*/

class _SimpleEmailForm
{
    public $to            = null;
    public $from          = null;
    public $fromName      = null;
    public $cc            = null;
    public $bcc           = null;
    public $replyTo       = null;
    public $replyToActive = false;
    public $attachment    = array();
    public $subject       = '';
    public $body          = '';
    public $dir           = '';
    public $copyMe        = '';
    public $copyMeAuto    = '';
    public $error         = '';
}

class sefhelper
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    // @TODO Create object abstraction (DIP) with appropriate interface(s)
    public function buildForm($params, $formObject = 'classic')
    {
        if ($formObject === 'jform') {
            // @TODO introduce JForm object here
        } else {
            return new \sefmodsimpleemailform($params);
        }
    }
}
