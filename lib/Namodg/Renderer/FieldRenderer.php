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
 * This is a general field renderer
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_FieldRenderer extends Namodg_RendererAbstract {

    /**
     * Namodg_Field object container
     *
     * @var Namodg_FieldAbstract
     */
    private $_field = NULL;

    /**
     * Initialize the field renderer
     *
     * @param string $tag
     * @param Namodg_FieldAbstract $field
     */
    public function __construct($tag, Namodg_FieldAbstract $field) {
        parent::__construct($tag);
        $this->_field = $field;
    }

    /**
     * Helper method, allows to add validation rules to the field.
     * The added attr can be used by client-side languages to validate the form before the submission.
     *
     * @param string $rule
     * @return Namodg_Renderer_FieldRenderer
     */
    public function addValidationRule($rule) {
        if ( $this->getAttr('data-validation') ) {
            $this->addAttr('data-validation', $this->getAttr('data-validation') . ' ' . $rule);
        } else {
            $this->addAttr('data-validation', $rule);
        }
        return $this;
    }

    /**
     * Renders the field's HTML
     *
     * @return string
     */
    public function render() {
        $html = '<' . $this->getTag() . ' ';

        $this->addAttr('name', $this->_getField()->getName());

        if ( $this->_getField()->getOption('id') ) {
            $this->setID( $this->_getField()->getOption('id') );
        }

        if ( $this->_getField()->getOption('class') ) {
            $this->addClass( $this->_getField()->getOption('class') );
        }

        if ( $this->_getField()->getOption('required') ) {
            $this->addValidationRule('required');
        }

        if ( $this->_getField()->getOption('title') ) {
            $this->addAttr('title', $this->_getField()->getOption('title'));
        }

        foreach ($this->getAllAttrs() as $attr => $value) {
            $html .= $attr . '="' . $value . '" ';
        }

        $html .= $this->_getClosingHTML();

        return $html;
    }

    /**
     *  Field getter method
     *
     * @return Namodg_FieldAbstract
     */
    protected function _getField() {
        return $this->_field;
    }

    /**
     * This allows to get the closing HTML of the field, based on the tag type.
     *
     * @return string
     */
    protected function _getClosingHTML() {
        switch ( $this->getTag() ) {
            case 'input':
                return 'value="' . $this->_getField()->getValue() . '">';
            case 'textarea':
                return ' cols="30" rows="10">' . $this->_getField()->getValue() . '</textarea>';
            case 'button':
                return 'value="' . $this->_getField()->getValue() . '">' . $this->_getField()->getValue() . '</button>';
            default:
                return 'value="' . $this->_getField()->getValue() . '">';
        }
    }

}

