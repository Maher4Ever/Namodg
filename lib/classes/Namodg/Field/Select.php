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
 * Namodg Select Field, used for data inside a dropdown
 *
 * @package Namodg
 */
class Namodg_Field_Select extends Namodg_FieldAbstract {

    public function __construct($name = NULL, $options = array()) {
        $this->_addDefaultOptions(array(
            'options' => array(),
            'empty' => NULL
        ));
        parent::__construct($name, $options);
    }

    public function getCleanedValue() {
        if ( $this->getValue() == $this->getOption('default')) {
            return '';
        } else {
            return filter_var( $this->getValue(), FILTER_SANITIZE_STRING);
        }
    }

    public function isValid() {
        $value = $this->getValue();

        if ($this->getOption('required') && ($value == $this->getOption('default') || empty($value)) ){
            $this->_setValidationError('required');
            return false;
        }

        return true;
    }

    public function getHTML() {
        $field = new Namodg_Renderer_SelectRenderer($this);
        return $field->render();
    }
}
