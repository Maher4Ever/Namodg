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
 * This renders the Namodg Select Field
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_SelectRenderer extends Namodg_Renderer_FieldRenderer {

    /**
     * Initialize the select field renderer
     *
     * @param Namodg_Field_Select $field
     */
    public function __construct(Namodg_Field_Select $field) {
        parent::__construct('select', $field);
    }

    /**
     * Renders the select field's HTML
     *
     * @return string
     */
    public function render() {
        $selectField = '<' . $this->getTag() . ' ';

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
            $selectField .= $attr . '="' . $value . '" ';
        }

        $selectField .= $this->_getClosingHTML() . PHP_EOL;

        // Adding Options

        $options = "\t" . '<option value="">' . $this->_getField()->getOption('default') . '</option>' . PHP_EOL;

        // Make sure that the options are an array and it's not empty before proceeding
        if ( ( $tmpOptions = is_array($this->_getField()->getOption('options')) ) && ! empty($tmpOptions) ) {

            foreach ( $this->_getField()->getOption('options') as $option ) {
                if ( $this->_getField()->getValue() == $option ) {
                    $options .= "\t" . '<option selected="selected" value="'. $option .'">' . $option . '</option>' . PHP_EOL;
                } else {
                    $options .= "\t" . '<option value="'. $option .'">' . $option . '</option>' . PHP_EOL;
                }
            }

        }

        return $selectField . $options . '</select>';
    }

    /**
     * This allows to get the closing HTML of the select field.
     * Note: This is used just to confirm to Namodg Spec!
     *
     * @return string
     */
    protected function _getClosingHTML() {
        return '>';
    }
}
