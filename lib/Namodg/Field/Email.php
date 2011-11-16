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
 * Namodg Email Field, used for email(string) data
 * 
 * @package Namodg
 */
class Namodg_Field_Email extends Namodg_FieldAbstract {

    public function isValid() {
        $value = $this->getValue();

        if ($this->getOption('required')) {
            if ( empty($value) ) {
                $this->_setValidationError('required');
                return false;
            }
        }

        // Validate the type of the value even if the field is not required 
        // when it's not empty
        if ( ! empty($value) && ! filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
            $this->_setValidationError('email_not_valid');
            return false;
        }

        return true;
    }

    public function getCleanedValue() {
        return filter_var( $this->getValue(), FILTER_SANITIZE_EMAIL);
    }

    public function getHTML() {
        $field = new Namodg_Renderer_FieldRenderer('input', $this);
        $field->addAttr('type', 'text');
        $field->addValidationRule('email');
        return $field->render();
    }

}
