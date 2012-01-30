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
 * The email validation ensures that a given
 * value's format is for an email. It is a simple
 * validation and thus it does not send an email
 * and waits on confirmation.
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 */
class Namodg_Validation_EmailValidation extends Namodg_ValidationAbstract {

  /**
   * Initialize the Validation
   */
  public function __construct() {
    $this->_setMessage('email_not_valid');
  }

  /**
   * Validates a given value and returns the result.
   *
   * @param string $value
   * @return boolean
   */
  public function isValid($value) {
    return $this->isValidateable($value) && filter_var($value, FILTER_VALIDATE_EMAIL) ;
  }

}
