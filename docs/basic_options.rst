.. _InstallationOptionsAnchor:

Configuration options
=====================

.. note:: When you move the pointer over a field, an explanation box pops up to assist you during module configuration.

.. image:: /image 01 d'une boîte d'explication

.. index:: Form type

Form type
---------

First, the form type must be chosen. **Classic** shows the form as it used to be.
This option is deprecated and won't be available in version 3.0 of the module.
**JForm** is the new version that integrates the new Joomla requirements.

..image:: /image 02/du/nouveau champ

.. index:: Language

Language
--------
You can then set the language used by the form.
Language files can be found and edited at
``/path/to/joomla/modules/mod_simpleemailform/language_files``.

You can choose from 30 different languages.

.. image:: /image/du champ langue

.. note:: The module is now integrated with Joomla native language support.

.. index:: Send Results To
.. index:: Email address

Email address
-------------
Next to **Send Results To**, you **must** enter an email address where
information gathered by the simple email form will be sent.
If there's more than one address, separate them with commas or spaces.

.. image:: /images/installation_options01.png/image/avec/plusieurs/adresses

.. index:: Label alignment

Label alignment
---------------
Choose to have the labels aligned LEFT, RIGHT or CENTER.

.. image:: /image du champ aligment

Field options
=============

Eight options can be used to configure each field:

* Activate Field X
* Label for Field X
* Default Value for Field X
* Display Size of Field X
* Maximum Length of Field X
* Field Type
* Field X Format
* Field X Before/After

.. image:: /les 8 champs 1

.. index:: Activate Field X

Activate Field X
----------------

Set this option to **Yes** to add field X to your form.
**No** means that field X won't appear in the form.
**Required** means that the user won't be able to send the form if the field is empty.
These fields are marked with an asterisk (*).

.. image:: /images/installation_options/champrequiredvide

**Hidden** fields don't appear on screen. The value is automatically added in the email sent to you.

.. index:: Label for Field X

Label for Field X
-----------------

Short description of the information to be entered by the user in this field.

.. index:: Default Value for Field X

Default Value for Field X
-------------------------

With field types **Subject**, **Normal**, **Text Area** and **User defined**, the value inserted here will appear
automatically in the field. It disappears as soon as the user enters some information.

.. image:: /image dans le formulaire

.. note:: This option is only available with the **Classic** type.

.. note:: Since version **1.8.5**, default values don't appear in Textarea fields. The HTML5 placeholder attribute is used instead.

With field types **Drop**, **Radio** and **Checkbox**, this option populates the answers
available to the user in this format:

``A=Apple,B=Banana,C=Cantelope``

In this case, the user will see Apple, Banana and Cantelope on screen.
If "Apple" is chosen, "A" is returned.

.. image:: /image de checkbox ou radio rempli avec apple, b et C

.. note:: To set a default for a **Drop**, **Radio** or **Checkbox** field, just make sure the desired default value is the first one specified.

.. index:: Display Size of Field X

Display Size of Field X
-----------------------

Size, in rows and columns, of a **Text area** field. Size is entered in the following format: row,column

With field types **Radio** and **Checkbox**, you can enter the width, in pixels, of the labels besides each radio button
or box.

**Display Size** has no effect on other field types.

.. note:: This option is only available with the **Classic** type.

.. index:: Maximum Length of Field X

Maximum Length of Field X
-------------------------

Highest number of characters accepted from the user.
Works only with field types **From**, **Subject** and **User defined**.

.. note:: This option is only available with the **Classic** type.

.. index:: Field Type

Field Type
----------

Different types of input you may offer to the user.
For more details about each one, see the **Field Type** section.

.. index:: Field X Format

Field X Format
--------------

Works only with **Radio** and **Checkbox** field types.
* **Horizontal** means that all radio buttons or checkboxes are on the same row.
.. image:: boîtes horizontales
* **Vertical** means that the various button-label pairs are displayed one above the other.
.. image:: boîtes verticales
* **Use CSS** means that you use your custom CSS to display the buttons or boxes.

.. index:: Field X Before/After

Field X Before/After
--------------------

Works only with **Radio** and **Checkbox** field types.
* **Before** means that labels are displayed to the left of their respective buttons or checkboxes.
* **After** means that they are displayed to the right.

.. index:: Field types

Field types
-----------
In version **2.0**, available field types are:
* From
* Subject
* Normal (text)
* Textarea
* Drop (select)
* Radio
* Checkbox
* User defined

.. index:: FROM field

FROM field
^^^^^^^^^^

This field type is used to get the email address of the user filling out the form. The first field defaults to **From**.

.. image:: /images/installation_options03.png

.. index:: SUBJECT field

SUBJECT field
^^^^^^^^^^^^^

Whatever the user enters here will become the "Subject" in the email sent to you.
The second field defaults to **Subject**.

.. image:: /images/installation_options04.png

.. index:: Normal field

Normal field
^^^^^^^^^^^^

This field will appear as one line on your input form.

If you do not wish to enter a **default value**, make sure to hit the **spacebar**.

**Maximum length** is the number of characters allowed in this field (only available in the **Classic** form type).

.. image:: /images/installation_options05.png

.. index:: Textarea field

Textarea field
^^^^^^^^^^^^^^

Creates a text box in which the user can type a message.
**Label** is the only field that is not ignored by this field type.

.. note:: The new JForm type displays an HTML editor.

.. note:: In the **Classic** form type, you can also set a default value.

.. image:: /images/installation_options06.png

.. index:: Drop (Select)

Drop (Select)
^^^^^^^^^^^^^

In the **Default Value** field, enter options separated by commas as follows: Return1=Visible1,Return2=Visible2.

ReturnX will be the value returned in the email message.
VisibleX is the value appearing in the form.

Format and Before/After are ignored for this field type.

.. image:: /images/installation_options09.png

.. index:: Radio buttons

Radio buttons
^^^^^^^^^^^^^

In the **Default Value** field, enter options separated by commas as follows: return1=visible1,return2=visible2.

returnX will be the value returned in the email message sent when that button
is selected and visibleX  is what is visible on the user screen.

**Horizontal** format is table/row/col/col/col.
**Vertical** format is table/row/col/col/row/col/col.
**Use CSS** (default) assumes you will use your custom CSS.

**Before** means that the label appears to the left of the button.
**After** means that the label appears to the right of the button.

.. image:: /images/installation_options07.png

.. index:: Checkboxes

Checkboxes
^^^^^^^^^^

In the **Default Value** field, enter options separated by commas as follows: return1=visible1,return2=visible2.

returnX will be the value returned in the email message sent when that checkbox is
selected and visibleX  is what is visible on the user screen.

**Horizontal** format is table/row/col/col/col.
**Vertical** format is table/row/col/col/row/col/col.
**Use CSS** (default) assumes you will use your custom CSS.

**Before** means that the label appears to the left of the button.
**After** means that the label appears to the right of the button.

.. image:: /images/installation_options08.png





