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
 * Namodg number field is used to reperesent
 * a HTML email input in PHP.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
class Namodg_Field_EmailField extends Namodg_FieldAbstract {

  /**
   * Initialize the field.
   *
   * @param Namodg_Validation_EmailValidation $validation
   * @param Namodg_Renderer_FieldRenderer $renderer
   * @param string $id
   * @param array $metaData
   */
  public function __construct(
    Namodg_Validation_EmailValidation $validation,
    Namodg_Renderer_FieldRenderer $renderer,
    $id = NULL,
    array $metaData = array()
  ) {
    parent::__construct($renderer, $id, $metaData);
    $this->addValidation($validation);
  }

  /**
   * Returns a sanitized version of the value
   * which safely can be saved in a database.
   *
   * @return string
   */
  public function getSanitizedValue() {
    return filter_var($this->getValue(), FILTER_SANITIZE_EMAIL);
  }

  /**
   * Returns the HTML markup of the field.
   *
   * @return string
   */
  public function getHTML() {
    $this->_getRenderer()->setAttribute('type', 'email')
                         ->addValidationRule('email');
    return parent::getHtml();
  }

}
