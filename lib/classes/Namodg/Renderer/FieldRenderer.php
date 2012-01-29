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
 * The renderer of Namodg fields.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_FieldRenderer extends Namodg_Renderer_TagRenderer {

  /**
   * Initialize the fields renderer
   *
   * @param DOMDocument $builder
   * @param string $tag
   */
  public function __construct(DOMDocument $builder) {
    parent::__construct($builder, 'input');
  }

  /**
   * Sets the content of the field.
   *
   * @param string $content
   * @return $this Allows chaining
   */
  public function setContent($content) {
    $this->setAttribute('value', $content);
    return $this;
  }

  /**
   * Returns the content of the field.
   *
   * @return string
   * @return $this Allows chaining
   */
  public function getContent() {
    return $this->getAttribute('value');
  }

  /**
   * Clears the content from the field.
   *
   * @return $this Allows chaining
   */
  public function clearContent() {
    $this->removeAttribute('value');
    return $this;
  }
}
