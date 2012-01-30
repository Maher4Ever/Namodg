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
 * The numeric validation ensures that a given
 * value is STRING with numbers in it.
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 */
class Namodg_Validation_NumericValidation extends Namodg_ValidationAbstract {

  /**
   * Initialize the Validation
   */
  public function __construct() {
    $this->_setMessage('not_numeric');
  }

  /**
   * Validates a given value and returns the result.
   *
   * @param string $value
   * @return boolean
   */
  public function isValid($value) {
    return $this->isValidateable($value) && preg_match('/^[0-9]+$/', $value);
  }
}
