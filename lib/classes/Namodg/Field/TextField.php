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
 * Namodg text field is used to reperesent
 * a HTML text input in PHP.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
class Namodg_Field_TextField extends Namodg_FieldAbstract {

  /**
   * Initialize the field.
   *
   * @param Namodg_Renderer_FieldRenderer $renderer
   */
  public function __construct(Namodg_Renderer_FieldRenderer $renderer) {
    parent::__construct($renderer);
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
    $this->getRenderer()->setAttribute('type', 'text');
    return parent::getHtml();
  }

}
