<?php

/**
 * Namodg - Form Generator
 * ========================
 *
 * Namodg is a class which allows to easily create, render, validate and process forms
 *
 * @author Maher Sallam <admin@namodg.com>
 * @link http://namodg.com
 * @copyright Copyright (c) 2010-2011, Maher Sallam
 *
 * Dual licensed under the MIT and GPL licenses:
 *   @license http://www.opensource.org/licenses/mit-license.php
 *   @license http://www.gnu.org/licenses/gpl.html
 */

/**
 * Namodg Submit Button, used to submit form's data
 *
 * @package Namodg
 */
class Namodg_Field_Submit extends Namodg_FieldAbstract {

    public function __construct($name = NULL, $value = null, $options = array()) {
        parent::__construct($name, $options);
        $this->setValue(is_null($value) ? $name : $value);
        $this->setOption('send', false);
    }

    public function isValid() {
        return true;
    }

    public function getCleanedValue() {
        return filter_var( $this->getValue(), FILTER_SANITIZE_STRING);
    }

    public function getHTML() {
        $field = new Namodg_Renderer_FieldRenderer('button', $this);
        $field->addAttr('type', 'submit');
        return $field->render();
    }

}
