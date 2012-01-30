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
 * A validation instance can validate a value
 * based on the type of the validation and
 * give information about the error.
 *
 * This interface defines the API for all the validations.
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 */
interface Namodg_ValidationInterface {

  /**
   * Validates a given value and returns the result.
   *
   * @param string $value The value to be validated
   * @return boolean The result of the validation
   */
  public function isValid($value);

  /**
   * Returns a message about the validation error.
   *
   * @return string The validation error
   */
  public function getMessage();

}
