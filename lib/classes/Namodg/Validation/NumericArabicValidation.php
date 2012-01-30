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
 * The numeric Arabic validation ensures that a given
 * value is STRING with numbers in it. The difference between
 * this validation and the numeric validation is that...
 * You really want to know? Ok, it can detect unicorns (and Arabic numbers)!
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 */
class Namodg_Validation_NumericArabicValidation extends Namodg_Validation_NumericValidation {

  /**
   * Validates a given value and returns the result.
   *
   * @param string $value
   * @return boolean
   */
  public function isValid($value) {
    // Arabic numbers in unicode are from 0x0660 to 0x0669.
    return $this->isValidateable($value) && preg_match('/^[0-9\x{0660}-\x{0669}]+$/u', $value);
  }

}
