Namodg - Form Generator 
========================

Namodg is a PHP class which allows to easily create, render, validate and process forms.

Usage
-----

This is a simple example of usage to render a form with one field using the simple configuration mode:
    
    require_once 'class.namodg.php';

    $form = new Namodg('key_longer_than_10_chars');
    $form
        ->addTextField('Name')
        ->addSubmit('Send');
    echo $form;

Namodg Modes
------------

###Simple configuration mode

Simple configuration mode means that Namodg needs only a key to encrypt your data and will use 
it's defaults for the rest of the settings.

###Advanced configuration mode

In the simple configuration mode, the form's `action` attribute will be set to the same page.
If you with to change this, use the advanced configuration mode. Here is an example:

    $form = new Namodg(array(
        'key' => 'key_longer_than_10_chars',
        'url' => 'process.php',
        'method' => 'post',
        'id' => 'contact-form'
    ));

Now the `action` attribute will be set to `process.php`

Namodg Fields
-------------

Namodg has a set of several fields which can be customized to meet users needs.

Here is an example of a page with 2 fields and their labels. These fields will be auto-validated
when the form is validated:
    
    require_once 'class.namodg.php';
    
    $form = new Namodg(array(
        'key' => 'key_longer_than_10_chars',
        'url' => 'process.php',
        'method' => 'post',
        'id' => 'contact-form'
    ));

    $form
        ->addTextField('Name', array(
            'required' => true,
            'label' => 'Your name:'
        ))

        ->addEmail('Email', array(
            'required' => true,
            'id' => 'email',
            'label' => 'Your email:'
        ))

        ->addSubmit('Send');
      
     echo $form;

Data Validation
---------------

Each Namodg field has a validation method based on it's name. That makes processing data a piece of cake!

Here is an example of the `process.php` page:

    require_once 'class.namodg.php';

    $form = new Namodg('key_longer_than_10_chars');
    
    // Check the data passed to this file. If there is no data or the data
    // can't be decrypted using the key, redirect the user to the homepage.
    if ( ! $form->canBeProcessed() ) {
        header('Location: index.php');
    }

    $form->validate();

    if ( $form->isDataValid() ) {

        // Use the valid data, ex:
        echo 'Your name: ' . $form->getField('Name')->getCleanedValue();

    } else {
        
        print_r( $form->getValidationErrors() );

    }