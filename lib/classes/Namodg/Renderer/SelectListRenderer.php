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
 * The renderer of select lists.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_SelectListRenderer extends Namodg_Renderer_FieldRenderer {

  /**
   * The default option for the select list.
   * When not set, the generated HTML won't have
   * default option.
   *
   * @var string
   */
  private $_defaultOption = NULL;

  /**
   * The selected option in the select list. If the same
   * option has already been added to the options list,
   * that option will take precedence.
   *
   * @var string
   */
  private $_selectedOption = NULL;

  /**
   * Internal storage for the options of the select list.
   *
   * @var array
   */
  private $_options = array();

  /**
   * Initialize the select-field renderer
   *
   * @param DOMDocument $builder
   */
  public function __construct(DOMDocument $builder) {
    parent::__construct($builder, 'select');
  }

  /**
   * Adds an option to the select list.
   *
   * @param string $value
   * @return $this Allows chaining
   */
  public function addOption($value) {
    if ( $value ) {
      $this->_options[] = $value;
    }
    return $this;
  }

  /**
   * Removes an option from the select list.
   *
   * @param string $value
   * @return $this Allows chaining
   */
  public function removeOption($value) {
    if ( in_array($value, $this->_options) ) {
      $i = array_search($value, $this->_options);
      unset($this->_options[$i]);
    }

    return $this;
  }

  /**
   * Sets the default option for the select list.
   *
   * @param string $value
   * @return $this Allows chaining
   */
  public function setDefaultOption($value) {
    $this->_defaultOption = $value;
    return $this;
  }

  /**
   * Returns the default option for the select list
   * if it exists, otherwise a null.
   *
   * @return mixed
   */
  public function getDefaultOption() {
    return $this->_defaultOption;
  }

  /**
   * Clears the default option for the select list.
   *
   * @return $this Allows chaining
   */
  public function clearDefaultOption() {
    $this->_defaultOption = NULL;
    return $this;
  }

  /**
   * Sets the selected option in the select list.
   *
   * @param string $value
   * @return $this Allows chaining
   */
  public function setSelectedOption($value) {
    $this->_selectedOption = $value;
    return $this;
  }

  /**
   * Returns the selected option in the select list
   * if it exists, otherwise a null.
   *
   * @return mixed
   */
  public function getSelectedOption() {
    return $this->_selectedOption;
  }

  /**
   * Clears the selected option in the select list.
   *
   * @return $this Allows chaining
   */
  public function clearSelectedOption() {
    $this->_selectedOption = NULL;
    return $this;
  }

  /**
   * Returns a list of all added options to the select list
   * including the selected option.
   *
   * @return array
   */
  public function getAllOptions() {
    $allOptions = $this->_options;
    $selectedOption = $this->getSelectedOption();

    if ( $selectedOption && ! in_array($selectedOption, $allOptions) ) {
      $allOptions[] = $selectedOption;
    }

    return $allOptions;
  }

  /**
   * Clears all options in the select list, including
   * the selected and default options.
   *
   * @return $this Allows chaining
   */
  public function clearAllOptions() {
    $this->_options = array();
    $this->clearDefaultOption()
      ->clearSelectedOption();

    return $this;
  }

  /**
   * Renders the select-list's HTML
   *
   * @return string
   */
  public function render() {
    $field = $this->_getBuilder()->createElement($this->getTag());

    foreach ($this->getAllAttributes() as $attr => $value) {
      $field->setAttribute($attr, $value);
    }

    if ( $defaultOption = $this->getDefaultOption() ) {
      $optionElem = $this->_getBuilder()->createElement('option');
      $optionElem->appendChild($this->_getBuilder()->createTextNode($defaultOption));
      $field->appendChild($optionElem);
    }

    foreach ($this->getAllOptions() as $option) {
      $optionElem = $this->_getBuilder()->createElement('option');
      $optionElem->setAttribute('value', $option);

      if ( $option === $this->getSelectedOption())  {
        $optionElem->setAttribute('selected', 'selected');
      }

      $optionElem->appendChild($this->_getBuilder()->createTextNode($option));

      $field->appendChild($optionElem);
    }

    $this->_getBuilder()->appendChild($field);

    return trim($this->_getBuilder()->saveHTML());
  }
}
