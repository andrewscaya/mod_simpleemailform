.. _InstallationOptionsAnchor:

Installation options
====================

.. note:: This article is still under construction and will be updated over time!

.. note:: The appearance of the module configuration screen has changed in 1.8.1+.

.. image:: /images/installation_options02.png

.. index:: Language

Language
--------
At the top, you will see options to set the language used by the form.
Language files can be found and edited at
``/path/to/joomla/modules/mod_simpleemailform/language_files``.

You can choose from 26 different languages

.. note:: At this time, the module is not integrated with Joomla native language support.  This option will be available in version 2.0!

.. index:: Send Results To
.. index:: Email address

Email address
-------------
Under that, you **must** enter an email address next to **Send Results To**.
This is the destination address where information gathered by the simple
email form will be sent.

.. image:: /images/installation_options01.png

Send results to this email address.   If more than one, separate with commas or
spaces.

.. index:: Label alignment

Label alignment
---------------
Choose to have the labels aligned LEFT, RIGHT or CENTER.

.. index:: Field types

Field types
-----------
In version **1.8.x** fields can now be normal (text), textarea, radio buttons,
checkboxes, or dropdown (select).

For dropdown (select), radio button, or checkbox fields, you can populate them
by supplying default values in this format:
 
``A=Apple,B=Banana,C=Cantelope``
 
In this case, the customer will see Apple, Banana and Cantelope on screen.
If "Apple" is chosen, "A" is returned, etc.

.. note:: When you move your mouse over any of the fields, additional explanation boxes will pop up to assist you during module configuration.

.. note:: New to version **1.8.5+**: the default values now appear using the HTML5 placeholder attribute. Defaults will not appear in Textarea fields.

.. note:: To set a default for a radio button, drop-down select, or checkbox field, just make sure the desired default value is the first one specified. (See notes below for more information.)

Any field can be Active (Yes), inactive (No), Required, or Hidden.

If the field is not a radio button or checkbox field:
**ignore** FIELD x FORMAT and FIELD x BEFORE/AFTER!!!

.. index:: Hidden Fields

**Hidden Fields**

* will not appear on screen and,
* the value will appear automatically in the email sent to you.

Format and Before/After are ignored for this field type.

.. index:: FROM field

FROM field
^^^^^^^^^^
.. image:: /images/installation_options03.png

The first field defaults to **From**.

Format and Before/After are ignored for this field type.

.. index:: SUBJECT field

SUBJECT field
^^^^^^^^^^^^^
The second field defaults to **Subject**.

.. image:: /images/installation_options04.png

The default value is what will appear in the form next to "Subject".

Whatever the user enters will become the "Subject" in the email sent to you.

Format and Before/After are ignored for this field type.

.. index:: NORMAL field

NORMAL field
^^^^^^^^^^^^
.. image:: /images/installation_options05.png

Above is an example of a **Normal** text field.

This field will appear as one line on your input form.

If you do not wish to enter a default value, make sure to hit the **spacebar**!

You can configure the size of the field which will appear in your email form
(ignored if you want this field to be a textarea).

You can also configure the maximum number of characters allowed in this field.

Format and Before/After are ignored for this field type.

.. index:: Textarea fields

Textarea fields
^^^^^^^^^^^^^^^
For textareas, you need to specify, in the size field, a value: rows,cols.
 
So if you enter 4,40 you will get a textarea of 4 rows X 40 columns, etc.

**If you place your mouse over any of the options, a pop-up description will
appear with more information.**

.. image:: /images/installation_options06.png

Above is an example of a **Textarea**.

You must enter the "Display SIze of Field x" parameter as two values separated
by a comma: *rows, columns*.

The example above will display a textarea for comments 4 rows by 60 columns in size.

Maximum length and display size are ignored.

Format and Before/After are ignored for this field type.

.. index:: Radio buttons

Radio buttons
^^^^^^^^^^^^^
.. image:: /images/installation_options07.png

The example above is an example of **Radio Buttons**.

Enter options separated by commas as follows: return1=visible1,return2=visible2.

returnX will be the value returned in the email message sent when that button
is selected and visibleX  is what is visible onscreen.

Horizontal format is table/row/col/col/col; Vertical format is table/row/col/col/row/col/col.

Use CSS (default) assumes you will use CSS.

You can also choose whether the label  appears **before** or **after** the button.

.. index:: Checkboxes

Checkboxes
^^^^^^^^^^
.. image:: /images/installation_options08.png

The example above is an example of **Checkboxes**.

Enter options separated by commas as follows: return1=visible1,return2=visible2.

returnX will be the value returned in the email message sent when that button is
selected and visibleX  is what is visible onscreen.

Horizontal format is table/row/col/col/col; Vertical format is table/row/col/col/row/col/col.

Use CSS (default) assumes you will use CSS.

You can also choose whether the label  appears *before* or *after* the checkbox.

.. index:: Drop (Select)

Drop (Select)
^^^^^^^^^^^^^
.. image:: /images/installation_options09.png

The example above is an example of **Drop (Select)**.

Enter options separated by commas as follows: return1=visible1,return2=visible2.

returnX will be the value returned in the email message sent when that button
is selected and visibleX is what is visible onscreen.

Format and Before/After are ignored for this field type.

.. index:: Reset fields

Reset fields
------------
.. image:: /images/installation_options10.png

Set the above option to YES if you wish to have form fields automatically
reset after form submission.

For **any** of the options, including **Advanced Options**, for more help,
simply move your mouse over the field!

.. index:: Redirect URL

For **Redirect URL**, make sure you enter a **fully formed** URL.

Example: enter "http://www.unlikelysource.com/"

.. note:: Please replace "www.unlikelysource.com" with the appropriate URL.

.. image:: /images/installation_options11.png

.. image:: /images/installation_options12.png

.. index:: CAPTCHA options

.. note:: CAPTCHA options only apply to Image CAPTCHAs!

For further details, please see the page :doc:`demo_config`!