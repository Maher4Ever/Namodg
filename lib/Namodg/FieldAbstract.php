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
 * The bluebrint for all Namodg_FieldInterfaces classes.
 * It sets the default behavior of Namodg_FieldInterfaces objects.
 * 
 * @package Namodg
 */
abstract class Namodg_FieldAbstract implements Namodg_FieldInterface {

    /**
     * Field name
     *
     * @var string
     */
    private $_name = NULL;

    /**
     * Field value
     *
     * @var string
     */
    private $_value = NULL;

    /**
     * Field Options
     *
     * @var array
     */
    private $_options = array();

    /**
     * Field validation error
     *
     * @see $this->_setValidationError()
     * @var string
     */
    private $_validatonError = NULL;

    /**
     * Initialize the field object
     *
     * @param string $name
     * @param array $options
     */
    public function __construct($name = NULL, $options = array()) {
        $name = trim($name);
        $this->_name = !$name ? uniqid( $this->getType() . '_' ) : $name;
        $this->_addDefaultOptions(array(
            'id' => NULL,
            'class' => NULL,
            'required' => FALSE,
            'label' => NULL,
            'title' => NULL,
            'send' => TRUE
        ));
        $this->_setOptions($options);
    }

    /**
     * Name getter
     *
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * Value setter
     *
     * @param string $value
     * @return $this Allows chaining
     */
    public function setValue($value) {
        $this->_value = $value;
        return $this;
    }

    /**
     * Value getter
     *
     * @return string
     */
    public function getValue() {
        return $this->_value;
    }

    /**
     * Field type gette, based on it's name
     * 
     * @return string
     */
    public function getType() {
        $class = get_class($this);
        return (string)strtolower( substr($class, strlen('Namodg_Field_') ) );
    }

    /**
     * Field options setter
     *
     * @param string $id option id
     * @param string $value
     * @return $this Allows chaining
     */
    public function setOption($id, $value) {
        $this->_options[$id] = $value;
        return $this;
    }

    /**
     * Field option getter
     *
     * @param string $id
     * @return string
     */
    public function getOption($id) {
        return isset($this->_options[$id]) ? $this->_options[$id] : null;
    }

    /**
     * Field error setter, changes the current field error to the last one
     * 
     * @param $errorID
     * @return $this Allows chaining
     */
    protected function _setValidationError($errorID) {
        $this->_validatonError = $errorID;
        return $this;
    }

    /**
     * Field error getter
     * 
     * @return string
     */
    public function getValidationError() {
        return $this->_validatonError;
    }

    /**
     * Allows to add extra default options
     * 
     * @param array $options
     * @return $this Allows chaining
     */
    protected function _addDefaultOptions($options) {
        if ( is_array($options) ) {
            $this->_options = array_merge($this->_options, $options);
        }
        return $this;
    }

    /**
     * Mereges the passed options array with the default options
     *
     * @param array $options
     * @return $this Allows chaining
     */
    private function _setOptions($options) {
        $this->_options = array_merge($this->_options, $options);
        return $this;
    }

}
