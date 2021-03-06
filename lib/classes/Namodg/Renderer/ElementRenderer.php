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
 * A general renderer for HTML elements. It can render
 * one DOM node with its attributes and content.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_ElementRenderer extends Namodg_RendererAbstract {

  const VALIDATION_ATTRUBUTE = 'data-namodg-validation';

  /**
   * HTML builder
   *
   * @var DOMDocument
   */
  private $_builder;

  /**
   * Initialize the elements renderer
   *
   * @param DOMDocument $builder
   * @param string $element
   */
  public function __construct(DOMDocument $builder, $element) {
    parent::__construct($element);

    $this->_builder = $builder;
  }

  /**
   * Adds a validation rule to the element.
   * The validation attribute can be used by client-side languages
   * to validate elements before the submission.
   *
   * @param string $rule
   * @return $this Allows chaining
   */
  public function addValidationRule($rule) {
    if ( $attr = $this->getAttribute(self::VALIDATION_ATTRUBUTE) ) {
      $this->setAttribute(self::VALIDATION_ATTRUBUTE, $attr . ' ' . $rule);
    }
    else {
      $this->setAttribute(self::VALIDATION_ATTRUBUTE, $rule);
    }

    return $this;
  }

  /**
   * Remove a validation rule from the element only
   * if it exists.
   *
   * @param string $rule
   * @return $this Allows chaining
   */
  public function removeValidationRule($rule) {
    if ( $attr = $this->getAttribute(self::VALIDATION_ATTRUBUTE) ) {
      $this->setAttribute(self::VALIDATION_ATTRUBUTE,
        preg_replace('/' . preg_quote($rule) . '[ ]?/', '', $attr)
      );
    }

    return $this;
  }

  /**
   * Clears all validation rules from the element.
   *
   * @return $this Allows chaining
   */
  public function clearAllValidationRules() {
    $this->removeAttribute(self::VALIDATION_ATTRUBUTE);

    return $this;
  }

  /**
   * Renders a element's HTML
   *
   * @return string
   */
  public function render() {
    $element = $this->_getBuilder()->createElement($this->getTag());

    foreach ($this->getAllAttributes() as $attr => $value) {
      $element->setAttribute($attr, $value);
    }

    if ( $content = $this->getContent() ) {
      $element->appendChild($this->_getBuilder()->createTextNode($content));
    }

    $this->_getBuilder()->appendChild($element);

    return trim($this->_getBuilder()->saveHTML());
  }

  /**
   * Returns the HTML builder
   *
   * @return DOMDocument
   */
  protected function _getBuilder() {
    return $this->_builder;
  }
}
