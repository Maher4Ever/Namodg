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
 * The general renderer for Namodg fields.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_FieldRenderer extends Namodg_RendererAbstract {

  const VALIDATION_ATTRUBUTE = 'data-namodg-validation';

  /**
   * HTML builder
   *
   * @var DOMDocument
   */
  private $_builder;

  /**
   * Initialize the fields renderer
   *
   * @param DOMDocument $builder
   * @param string $tag
   */
  public function __construct(DOMDocument $builder, $tag) {
    parent::__construct($tag);

    $this->_builder = $builder;
  }

  /**
   * Adds a validation rule to the field.
   * The validation attribute can be used by client-side languages
   * to validate the form before the submission.
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
   * Remove a validation rule from the field only
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
   * Clears all validation rules from the field.
   *
   * @return $this Allows chaining
   */
  public function clearAllValidationRules() {
    $this->removeAttribute(self::VALIDATION_ATTRUBUTE);

    return $this;
  }

  /**
   * Renders the field's HTML
   *
   * @return string
   */
  public function render() {
    $field = $this->_getBuilder()->createElement($this->getTag());

    foreach ($this->getAllAttributes() as $attr => $value) {
      $field->setAttribute($attr, $value);
    }

    $this->_getBuilder()->appendChild($field);

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
