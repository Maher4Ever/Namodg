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
 * Namodg textarea field is used to represent
 * a HTML textrea in PHP.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
class Namodg_Field_Textarea extends Namodg_FieldAbstract {

  /**
   * Initialize the field.
   *
   * @param Namodg_Renderer_TextareaRenderer $renderer
   * @param string $id
   * @param array $metaData
   */
  public function __construct(Namodg_Renderer_TextareaRenderer $renderer, $id = NULL, array $metaData = array()) {
    parent::__construct($renderer, $id, $metaData);
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

}
