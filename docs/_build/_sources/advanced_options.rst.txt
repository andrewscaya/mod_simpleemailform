.. _AdvancedOptionsAnchor:

Advanced configuration options
==============================

.. index:: Caching

Caching
-------

**Use global** means that this module's content will be cached according to your Joomla's global cache settings.

**No caching** means that no content from this module will be cached.

This option is provided by `Joomla <https://docs.joomla.org/Help36:Extensions_Module_Manager_Tags_Popular#Advanced>`_.

.. index:: Form Instance

Form Instance
-------------

If you use more than one **Classic** forms on your website, even on different pages, you need to give
each one of them a unique number to differentiate them from each other.

.. index:: Send Results CC

Send Results CC
---------------

Enter email addresses here if you want the form to be sent in carbon copy.

.. index:: Send Results BCC

Send Results BCC
----------------

Enter email addresses here if you want the form to be sent in blind carbon copy.

.. index:: Reply To this address

Reply To this address
---------------------

Enter email addresses where replies should be sent to.

.. index:: Activate Reply To

Activate Reply To
-----------------

If set to **Yes**, a "Reply to" field will appear when the email is sent.

.. index:: Auto Reset Fields

Auto Reset Fields
-----------------

**Yes** means that all fields will be cleared when the user submits the form.

**No** means that the values entered by the user will remain after the form is submitted.

.. note:: With the **JForm** type, **No** is automatically used.

.. index:: Name of CSS Class

Name of CSS Class
-----------------

Enter the name of the CSS class that will be used with the form.

.. index:: Space After Labels

Space After Labels
------------------

Amount of pixels between the labels to the left of the form and their input fields.

.. index:: Redirect URL

Redirect URL
------------

Enter a Website address where the user should be redirected after submitting the form.
Make sure you enter a **fully formed** URL.

Example: http://www.unlikelysource.com/

.. index:: Captcha Use

Use Captcha
-----------

With the **JForm** type:

To be able to use Captcha, you can follow the procedure on the `Joomla Website
<https://docs.joomla.org/How_do_you_use_Recaptcha_in_Joomla%3F>`_.

This will produce a captcha looking like this:

.. image:: /images/advanced_options01.png

.. note:: If you don't have a Google account and don't want to create one, you can use a Captcha extension available in the `Joomla Extensions Directory <https://extensions.joomla.org/tags/captcha>`_.

With the **Classic** form type:

Set to **No Captcha** if you don't want any Captcha protection.

**Image Captcha** creates an image including a background rectangle, characters the user
will have to type and lines blurring the image.

.. image:: /images/advanced_options02.png

**Text Captcha** creates a simple character string the user has to type.

.. image:: /images/advanced_options03.png

.. index:: Directory to Write Captchas

Directory to Write Captchas
---------------------------

An absolute path where captchas will be written.

Example : /var/www/application/images

Make sure that the repository is writable.

.. index:: URL for Captcha Directory

URL for Captcha Directory
-------------------------

URL matching the directory specified above.

.. index:: Captcha Word Length

Captcha Word Length
-------------------

Number of characters the user will need to enter.

.. index:: Captcha Font Size

Captcha Font Size
-----------------

Size of the characters in the captcha image.

.. index:: Captcha Width

Captcha Width
-------------

Width in pixels of the captcha image.

.. index:: Captcha Height

Captcha Height
--------------

Height in pixels of the captcha image.

.. index:: Captcha Text Color

Captcha Text Color
------------------

The color of the characters in the captcha image.

.. index:: Captcha Lines Color

Captcha Lines Color
-------------------

The color of the lines partially hiding the characters in the captcha image.

.. index:: Captcha Background Color

Captcha Background Color
------------------------

The color of the captcha image background.

.. index:: Error Text Color

Error Text Color
----------------

The color in which error messages are displayed to the user.

.. index:: Success Text Color

Success Text Color
------------------

The color in which success messages are displayed to the user.

.. index:: Name of Anchor Tag

Name of Anchor Tag
------------------

After submitting the form, the user is redirected to the anchor tag mentioned here.
By default, this tag is placed at the beginning of the form.

The name of the tag must start with #. Example : #tag

.. index:: Number of Upload Fields

Number of Upload Fields
-----------------------

Determines the number of attachments users can or must send through the form.

.. index:: Upload Field Label

Upload Field Label
------------------

The label for the upload fields.

.. index:: Allowed Attachment Filenames

Allowed Attachment Filenames
----------------------------

List of approved filename extensions, separated by commas.

.. index:: Are upload fields required

Are upload fields required?
---------------------------

If set to **Yes**, submitting the form will fail with an error if
an upload field is empty.

.. note:: This new feature is only available with the **JForm** type.

.. index:: Directory to Save Attachments

Directory to Save Attachments
-----------------------------

An absolute path to the directory in which attachments sent by users will be saved.

.. index:: Send Me an Email Field Label

Send Me an Email Field Label
----------------------------

The label for field **Send Me an Email**, set below.

.. index:: Send Me an Email Field

Send Me an Email Field
----------------------

If set to **Yes**, users can ask to receive a copy of the form that they send.

.. index:: Send User an Email Automatically

Send User an Email Automatically
--------------------------------

If set to **Yes**, users will always receive a copy of the form that they send.

.. index:: Send User a Custom Messasge
.. _custom-message:

Send User a Custom Message
--------------------------

If the **Send User an Email Automatically** option is set to **Yes**, you can fill out this section
to send your user a custom message.

.. index:: Email Check

Email Check
-----------

If set to **Yes**, the data entered in the **From** field is validated and must
follow the format emailaccount@domain.

.. note:: With the **JForm** type, this validation occurs automatically.

.. index:: Include Article Title

Include Article Title
---------------------

If set to **Yes**, the Joomla article title is automatically included
in a hidden field added to the email.

.. index:: Test Mode

Test Mode
---------

If set to **Yes**, the form is used in test mode.

.. index:: Override rendering
.. _override-rendering:

Override rendering
------------------

Set this option to **Yes** if you want to use your own template to
modify the module's display. To get you started, you can copy the **mod_simpleemailform/tmpl/default_custom.php.dist**
and name it **default_custom.php**.

You can also give your custom file another name, but you will have to insert your chosen name on line 7 of the
**default.php** template file.

.. index:: Override strings
.. _override-strings:

Override strings
----------------

Set this option to **Yes** if you want to use Joomla's
`language overrides feature <https://docs.joomla.org/J3.x:Language_Overrides_in_Joomla>`_.
Searching for constants with "MOD_SIMPLEEMAILFORM" will give you a list of all the strings that can be overriden in this
module.

Thanks to this feature, you won't lose your changes the next time you update Simple Email Form.

.. index:: Module Tag

Module Tag
----------

The html tag used for the module. This option is provided by `Joomla <https://docs.joomla.org/Help36:Extensions_Module_Manager_Tags_Popular#Advanced>`_.

.. index:: Bootstrap Size

Bootstrap Size
--------------

The number of columns used in the module. This option is provided by `Joomla <https://docs.joomla.org/Help36:Extensions_Module_Manager_Tags_Popular#Advanced>`_.

.. index:: Header Tag

Header Tag
----------

The HTML tag used for module headers and titles. This option is provided by `Joomla <https://docs.joomla.org/Help36:Extensions_Module_Manager_Tags_Popular#Advanced>`_.

.. index:: Header Class

Header Class
------------

The CSS class used for module headers and titles. This option is provided by `Joomla <https://docs.joomla.org/Help36:Extensions_Module_Manager_Tags_Popular#Advanced>`_.

.. index:: Module Style

Module Style
------------

The option used to override the template style. It is provided by `Joomla <https://docs.joomla.org/Help36:Extensions_Module_Manager_Tags_Popular#Advanced>`_.