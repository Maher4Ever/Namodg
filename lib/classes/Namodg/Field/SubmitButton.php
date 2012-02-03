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
 * Namodg submit button is used to reperesent
 * a HTML submit input in PHP.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
class Namodg_Field_SubmitButton extends Namodg_FieldAbstract {

  /**
   * Initialize the field.
   *
   * @param Namodg_Renderer_FieldRenderer $renderer
   */
  public function __construct(Namodg_Renderer_FieldRenderer $renderer) {
    parent::__construct($renderer);
    $this->setMetaAttribute('send', FALSE);
  }

  /**
   * Adds a validation object to the field.
   *
   * @throws BadMethodCallException
   */
  public function addValidation(Namodg_ValidationInterface $validation) {
    throw new BadMethodCallException(
      'You can not add validations to submit buttons because their values are always valid!'
    );
  }

  /**
   * Returns a list of all validations added to the field.
   *
   * @throws BadMethodCallException
   */
  public function getAllValidations() {
    throw new BadMethodCallException(
      'Submit buttons does not have validations. As a result, none can be returned!'
    );
  }

  /**
   * Returns a sanitized version of the value
   * which safely can be saved in a database.
   *
   * @return string
   */
  public function getSanitizedValue() {
    return filter_var($this->getValue(), FILTER_SANITIZE_STRING);
  }

  /**
   * Returns the HTML markup of the field.
   *
   * @return string
   */
  public function getHtml() {
    $this->getRenderer()->setAttribute('type', 'submit');
    return parent::getHtml();
  }

}
