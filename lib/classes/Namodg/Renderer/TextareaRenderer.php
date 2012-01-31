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
 * The renderer of Namodg textarea fields.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_TextareaRenderer extends Namodg_Renderer_ElementRenderer {

  /**
   * Initialize the fields renderer
   *
   * @param DOMDocument $builder
   */
  public function __construct(DOMDocument $builder) {
    parent::__construct($builder, 'textarea');
  }

}
