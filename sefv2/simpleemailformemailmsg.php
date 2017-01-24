<?php

/**
 * simpleemailformemailmsg.php
 *
 * Copyright 2010 - 2017 D. Bierer <doug@unlikelysource.com>
 * Version 2.0.0
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 * @package    Simple Email Form
 * @copyright  Copyright 2010 - 2017 D. Bierer <doug@unlikelysource.com>
 * @link       http://joomla.unlikelysource.org/
 * @license    GNU/GPLv2, see above
 * @since 2.0.0
 */

/**
 * The Simple Email Form Email Message Container.
 *
 * @package Simple Email Form
 *
 * @since 2.0.0
 */
class sefv2simpleemailformemailmsg
{
    /**
     * @var null|string
     * @since 2.0.0
     */
    public $to            = null;

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $from          = null;

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $fromName      = null;

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $cc            = null;

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $bcc           = null;

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $replyTo       = null;

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $replyToActive = false;

    /**
     * @var array
     * @since 2.0.0
     */
    public $attachment    = array();

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $subject       = '';

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $body          = '';

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $dir           = '';

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $copyMe        = '';

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $copyMeAuto    = '';

    /**
     * @var null|string
     * @since 2.0.0
     */
    public $error         = '';
}
