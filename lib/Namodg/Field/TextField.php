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
 * Namodg Text Field, used for one-line string data
 * 
 * @package Namodg
 */
class Namodg_Field_TextField extends Namodg_FieldAbstract {

    public function isValid() {
        $value = $this->getValue();

        if ($this->getOption('required') && empty($value)) {
            $this->_setValidationError('required');
            return false;
        }

        return true;
    }

    public function getCleanedValue() {
        return filter_var( $this->getValue(), FILTER_SANITIZE_STRING);
    }

    public function getHTML() {
        $field = new Namodg_Renderer_FieldRenderer('input', $this);
        $field->addAttr('type', 'text');
        return $field->render();
    }
}
