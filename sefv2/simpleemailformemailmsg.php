<?php

/**
 * simpleemailformemailmsg.php
 *
 * Copyright 2010 - 2018 D. Bierer <doug@unlikelysource.com>
 * Version 2.3.0
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
 * @copyright  Copyright 2010 - 2018 D. Bierer <doug@unlikelysource.com>
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
     * Contains a string signifying the recipient's email address.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $to            = null;

    /**
     * Contains a string signifying the sender's email address.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $from          = null;

    /**
     * Contains a string signifying the sender's name.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $fromName      = null;

    /**
     * Contains a string signifying the value of the cc email addresses.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $cc            = null;

    /**
     * Contains a string signifying the value of the bcc email addresses.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $bcc           = null;

    /**
     * Contains a string (or an array of strings if Joomla < 3.0) signifying the value of
     * the email address parameter that will be in the replyTo field of the email.
     *
     * @var mixed
     * @since 2.0.0
     */
    public $replyTo       = null;

    /**
     * Contains a string signifying that the replyTo field has to be added or not to the email.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $replyToActive = 'N';

    /**
     * Contains an array of attached documents.
     *
     * @var array
     * @since 2.0.0
     */
    public $attachment    = array();

    /**
     * Contains a string signifying the value of the email' subject.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $subject       = '';

    /**
     * Contains a string signifying the value of the email' body.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $body          = '';

    /**
     * Contains a string signifying the value of the directory containing the attachments.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $dir           = '';

    /**
     * Contains a boolean signifying that the value of the form's field was set or not.
     *
     * @var null|bool
     * @since 2.0.0
     */
    public $copyMe        = false;

    /**
     * Contains a boolean signifying that the value of the form's parameter was set or not.
     *
     * @var null|string
     * @since 2.0.0
     */
    public $copyMeAuto    = false;

    /**
     * Contains a string signifying the value of the error message if an error occurred when sending the email.
     *
     * @deprecated 2.1.0
     *
     * @var null|string
     * @since 2.0.0
     */
    public $error         = '';
}
