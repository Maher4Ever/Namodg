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
 * The simple Arabic captcha validation works exactly like
 * the simple captcha validation but with one difference...
 * It accepts Arabic numbers as the result of the equation.
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 * @see Namodg_Validation_CaptchaSimpleValidation
 */
class Namodg_Validation_CaptchaSimpleArabicValidation extends Namodg_Validation_CaptchaSimpleValidation {

  /**
   * A cache for the REGEX pattren
   * of the answer in Arabic.
   *
   * @var string
   * @see _generatePattren()
   */
  private $_pattren = NULL;

  /**
   * Initialize the Validation
   */
  public function __construct() {
    parent::__construct();
    $this->_generatePattren();
  }

  /**
   * Validates a given value and returns the result.
   *
   * @param string $value
   * @return boolean
   */
  public function isValid($value) {
    return parent::isValid($value) || preg_match($this->_pattren, $value);
  }

  /**
   * Generates the REGEX pattren of the answer in Arabic
   * and memoizes it to be used lateron when validating values.
   *
   * @return $this Allows chaining
   */
  private function _generatePattren() {
    $answer = $this->_getAnswer();
    $pattren = '';

    // Convert the answer from Ascii to Arabic Unicode (in HEX)
    for($i = 0, $len = strlen($answer); $i < $len; ++$i) {

      // Arabic zero in unicode is 0x0660 and Zero in Ascii is 0x0048
      // Our base to convert: 660 - 48 = 612
      $pattren .= sprintf('\x{%d}', ord($answer[$i]) + 612);
    }

    $this->_pattren = '/^' . $pattren . '$/u';

    return $this;
  }

}
