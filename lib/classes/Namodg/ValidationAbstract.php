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
 * The base of all validations. It helps with creating
 * other validations by implementing the general aspects
 * of the validations' API.
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 */
abstract class Namodg_ValidationAbstract implements Namodg_ValidationInterface {

  /**
   * The validation error message
   *
   * @var string
   */
  private $_message;

  /**
   * Checks if the value can be further validated
   * and confirms to the validations' API.
   *
   * @param string $value
   * @return boolean
   */
  public function isValidateable($value) {
    return is_string($value);
  }

  /**
   * Sets the validation error message.
   *
   * @param string $message
   * @return $this Allows chaining
   */
  protected function _setMessage($message) {
    $this->_message = (string)$message;
    return $this;
  }

  /**
   * Returns the validation error message.
   *
   * @return string
   */
  public function getMessage() {
    return $this->_message;
  }

}
