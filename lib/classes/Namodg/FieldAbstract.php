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
 * The base for all Namodg fields. It provides subclasses with
 * a generic implementation of the fields' API.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
abstract class Namodg_FieldAbstract implements Namodg_FieldInterface {

  /**
   * Field HTML renderer.
   *
   * @var Namodg_Renderer_FieldRenderer
   */
  private $_renderer = NULL;

  /**
   * Field unique ID.
   *
   * @var string
   */
  private $_id = NULL;

  /**
   * Field value.
   *
   * @var string
   */
  private $_value = NULL;

  /**
   * Field meta data.
   *
   * @var array
   */
  private $_meta = array(
    'send'     => TRUE
  );

  /**
   * Validation objects container.
   *
   * @var array
   */
  private $_validations = array();

  /**
   * Field validation error.
   *
   * @see $this->_setValidationError()
   * @var string
   */
  private $_validatonError = NULL;

  /**
   * Initialize the field.
   *
   * @param Namodg_Renderer_FieldRenderer $renderer
   * @param string $id
   * @param array $metaData
   */
  public function __construct(Namodg_Renderer_FieldRenderer $renderer, $id = NULL, array $metaData = array()) {
    $this->_renderer = $renderer;
    $id = trim((string)$id);
    $this->_id = !$id ? uniqid( $this->getType() . '_' ) : $id;
    $this->_addMetaData($metaData);
  }

  /**
   * Returns the unique identifier of the field.
   *
   * @return string
   */
  public function getId() {
    return $this->_id;
  }

  /**
   * Set the value of the field.
   *
   * @param string $value
   * @return $this Allows chaining
   */
  public function setValue($value) {
    $this->_value = (string)$value;
    return $this;
  }

  /**
   * Returns the value of the field
   * if it was set, otherwise a null.
   *
   * @return string
   */
  public function getValue() {
    return $this->_value;
  }

  /**
   * Returns an escaped version of the value
   * which can safely be used inside HTML.
   * if the value is not set, an empty string
   * is returned.
   *
   * @return string
   */
  public function getHtmlSafeValue() {
    if ( is_null($this->getValue()) ) {
      return '';
    }
    return htmlspecialchars($this->getValue(), ENT_QUOTES, 'UTF-8');
  }

  /**
   * Returns the type of the field.
   *
   * @return string
   */
  public function getType() {
    $class = get_class($this);
    return strtolower( substr($class, strlen('Namodg_Field_') ) );
  }

  /**
   * Sets a meta attribute on the field.
   *
   * @param string $name
   * @param mixed $value
   * @return $this Allows chaining
   */
  public function setMetaAttribute($name, $value) {
    $this->_meta[(string)$name] = $value;
    return $this;
  }

  /**
   * Returns the value of a meta attribute
   * if it was set, otherwise a null.
   *
   * @param string $name
   * @return mixed
   */
  public function getMetaAttribute($name) {
    return isset($this->_meta[$name]) ? $this->_meta[$name] : null;
  }

  /**
   * Returns a list of the meta attributes
   * on the field.
   *
   * @return array
   */
  public function getMetaData() {
    return $this->_meta;
  }

  /**
   * Adds a validation object to the field.
   *
   * @param Namodg_ValidationInterface $validation
   * @return $this Allows chaining
   */
  public function addValidation(Namodg_ValidationInterface $validation) {
    $this->_validations[] = $validation;
    return $this;
  }

  /**
   * Returns a list of all validations added to the field.
   *
   * @return array
   */
  public function getAllValidations() {
    return $this->_validations;
  }

  /**
   * Checks if the value is valid by
   * running it on all validations.
   *
   * @return boolean
   */
  public function isValueValid() {
    foreach($this->_validations as $validation) {
      if ( ! $validation->isValid($this->getValue()) ) {
        $this->_setValidationError($validation->getMessage());
        return false;
      }
    }
    return true;
  }

  /**
   * Checks if the field is set to
   * be a required field.
   *
   * @return boolean
   */
  public function isRequired() {
    foreach($this->_validations as $validation) {
      if ( $validation instanceof Namodg_Validation_RequiredValidation ) {
        return true;
      }
    }
    return false;
  }

  /**
   * Sets the validation error for the field.
   *
   * @param string $error
   * @return $this Allows chaining
   */
  protected function _setValidationError($error) {
    $this->_validatonError = (string)$error;
    return $this;
  }

  /**
   * Returns the validation error of the field.
   *
   * @return string
   */
  public function getValidationError() {
    return $this->_validatonError;
  }

  /**
   * Returns the HTML markup of the field.
   *
   * @return string
   */
  public function getHtml() {
    $this->_getRenderer()->setAttribute('name', $this->getId())
                         ->setContent($this->getHtmlSafeValue());

    if ( $this->isRequired() ) {
      $this->_getRenderer()->addValidationRule('required');
    }

    return $this->_getRenderer()->render();
  }

  /**
   * Adds meta data to the field. This is designed
   * to be used internally by subclasses.
   *
   * @param array $data
   * @return $this Allows chaining
   */
  protected function _addMetaData(array $data) {
    $this->_meta = array_merge($this->_meta, $data);
    return $this;
  }

  /**
   * Returns the field HTML renderer
   *
   * @return Namodg_Renderer_FieldRenderer
   */
  protected function _getRenderer() {
    return $this->_renderer;
  }
}
