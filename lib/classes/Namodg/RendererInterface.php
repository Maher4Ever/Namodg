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
 * A renderer instance can renderer HTML elements
 * based on the supplied tag and attributes.
 *
 * This interface defines the API for all the renderers.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
interface Namodg_RendererInterface {

  /**
   * Returns the HTML-tag which wil be rendered.
   *
   * @return string
   */
  public function getTag();

  /**
   * Sets an attribute for the HTML element.
   *
   * @param string $name Attribute name
   * @param string $value Attribute value
   */
  public function setAttribute($name, $value);

  /**
   * Returns the value of the given attribute name
   * if it exists, otherwise a null.
   *
   * @param string $name Attribute name
   * @return mixin The value of the attribute or a null
   */
  public function getAttribute($name);

  /**
   * Returns a list of all attributes which has been
   * added to the HTML element.
   *
   * @return array The attributes list
   */
  public function getAllAttributes();

  /**
   * Removes an attribute from the HTML element
   * if it was added, otherwise it won't do anything.
   *
   * @param string $name Attribute name
   */
  public function removeAttribute($name);

  /**
   * Clears the attributes list of the HTML element.
   */
  public function clearAllAttributes();

  /**
   * Renders the HTML element.
   *
   * @return string The HTML
   */
  public function render();
}
