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
 * The simple captcha validation tries to ensure that
 * a humanbeing is the one interacting with the system.
 * It uses a simple addition equation for that purpose,
 * but as the goal of this captcha is to keep it simple,
 * it is not highly reliable.
 *
 * @package Namodg
 * @subpackage Namodg_Validation
 */
class Namodg_Validation_CaptchaSimpleValidation extends Namodg_ValidationAbstract {

  /**
   * First number of the equation
   *
   * @var int
   */
  private $_ying = NULL;

  /**
   * Second number of the equation
   *
   * @var int
   */
  private $_yang = NULL;

    /**
   * Initialize the Validation
   */
  public function __construct() {
    $this->_ying = mt_rand(1, 9);
    $this->_yang = mt_rand(1, 9);
    $this->_setMessage('captcha_answer_wrong');
  }

    /**
   * Validates a given value and returns the result.
   *
   * @param string $value
   * @return boolean
   */
  public function isValid($value) {
    return $this->isValidateable($value) && $value === $this->_getAnswer();
  }

  /**
   * Returns the question (equation)
   *
   * @return string
   */
  public function getQuestion() {
    return $this->_ying . ' + ' . $this->_yang;
  }

  /**
   * Returns the answer if the equation
   *
   * @return string
   */
  protected function _getAnswer() {
    return (string)($this->_ying + $this->_yang);
  }
}
