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
 * Namodg Number Field, used for integer data
 * 
 * @package Namodg
 */
class Namodg_Field_NumberField extends Namodg_FieldAbstract {

    public function isValid() {
        $value = $this->getValue();

        if ($this->getOption('required')) {
            if ( empty($value) ) {
                $this->_setValidationError('required');
                return false;
            }
        }

        // Validate the type of the value even if the field is not required 
        // when it's not empty. Matches 0-9 and Arabic numbers.
        if ( ! empty($value) && ! preg_match( '/^[0-9\x{0660}-\x{0669}]+$/u', $value ) ) {
            $this->_setValidationError('not_number');
            return false;
        }

        return true;
    }

    public function getCleanedValue() {
        return filter_var( $this->getValue(), FILTER_SANITIZE_NUMBER_INT );
    }

    public function getHTML() {
        $field = new Namodg_Renderer_FieldRenderer('input', $this);
        $field->addAttr('type', 'text');
        $field->addValidationRule('number');
        return $field->render();
    }

}
