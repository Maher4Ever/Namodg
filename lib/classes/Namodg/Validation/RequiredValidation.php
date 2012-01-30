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

class Namodg_Validation_RequiredValidation extends Namodg_ValidationAbstract {

  public function __construct() {
    $this->_setMessage('required');
  }

  public function isValid($value) {
    $value = trim($value);
    return $this->isValidateable($value) && ! empty($value);
  }

}
