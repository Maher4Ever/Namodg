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
 * The blueprint of all renderers. It sets the default behavior
 * of render objects. It has extra helper methods like addClass()
 * and setId(). This renderer can be used to render any HTML tag.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
abstract class Namodg_RendererAbstract implements Namodg_RendererInterface {

  /**
   * HTML Tag container
   * @var string
   */
  private $_tag = NULL;

  /**
   * Tag attributes
   *
   * @var array
   */
  private $_attrs = array();

  /**
   * Initialize the renderer
   *
   * @param string $tag
   */
  public function __construct($tag) {
    $this->_tag = (string)$tag;
  }

  /**
   * Tag getter
   *
   * @return string
   */
  public function getTag() {
    return $this->_tag;
  }

  /**
   * Sets an attribute for the HTML element.
   *
   * @param string $name Attribute name
   * @param string $value Attribute value
   * @return $this Allows chaining
   */
  public function setAttribute($name, $value) {
    $name = strtolower($name);

    if ($name == 'id') {
      $this->setId($value);
    }
    elseif ($name == 'class') {
      $this->addClass($value);
    }
    else {
      $this->_attrs[$name] = $value;
    }

    return $this;
  }

  /**
   * Returns the value of the given attribute name
   * if it exists, otherwise a null.
   *
   * @param string $name Attribute name
   * @return mixin The value of the attribute or a null
   */
  public function getAttribute($name) {
    return isset($this->_attrs[$name]) ? $this->_attrs[$name] : NULL;
  }

  /**
   * Returns a list of all attributes which has been
   * added to the HTML element.
   *
   * @return array The attributes list
   */
  public function getAllAttributes() {
    return $this->_attrs;
  }

  /**
   * Removes an attribute from the HTML element
   * if it was added, otherwise it won't do anything.
   *
   * @param string $name Attribute name
   * @return $this Allows chaining
   */
  public function removeAttribute($name) {
    if ( isset($this->_attrs[$name]) ) {
      unset($this->_attrs[$name]);
    }

    return $this;
  }

  /**
   * Clears the attributes list of the HTML element.
   *
   * @return $this Allows chaining
   */
  public function clearAllAttributes() {
    $this->_attrs = array();
    return $this;
  }

  /**
   * Sets the ID attribute for the HTML element.
   *
   * @param string $idValue
   * @return $this Allows chaining
   */
  public function setId($idValue) {
    $this->_attrs['id'] = $idValue;
    return $this;
  }

  /**
   * Adds a CSS class to the HTML element.
   *
   * @param string $class
   * @return $this Allows chaining
   */
  public function addClass($class) {
    if ( isset($this->_attrs['class']) ) {
      $this->_attrs['class'] .= ' ' . $class;
    }
    else {
      $this->_attrs['class'] = $class;
    }

    return $this;
  }
}
