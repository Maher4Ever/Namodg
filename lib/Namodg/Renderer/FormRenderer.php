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
 * This class can be used to render a HTML form with it's fields.
 * It also offers an API to get parts of the form's HTML so that they can be used elsewhere.
 * 
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_FormRenderer extends Namodg_RendererAbstract {
    
    /**
     * Namodg_Field objects container
     *
     * @var array
     */
    private $_fields = NULL;
    
    /**
     * The key is used to encrypt the hidden Namodg field.
     * This field has a serialized version of the Namodg_Field objects
     *
     * @var string
     */
    private static $_key = NULL;
    
    /**
     * Initialize the form renderer
     *
     * @param array $fields Namodg_Field objects
     * @param string $key 
     */
    public function __construct($fields, $key) {
        parent::__construct('form');
        $this->_fields = $fields;
        self::$_key = $key;
    }
    
    /**
     * This allows to get the HTML of the opening form tag
     *  
     * @return string 
     */
    public function getOpeningHTML() {
        $html = '<form ';
        foreach ( $this->getAllAttrs() as $attr => $value) {
            $html .= $attr . '="' . $value . '" ';
        }
        $html .= '>' . PHP_EOL;
        
        // W3C doesn't allow inputs inside forms directly
        $html .= "\t<div>" . PHP_EOL;
        
        return $html;
    }

    /**
     * This allows to get the HTML of the closing form tag
     *
     * @return string
     */
    public function getClosingHTML() {
        
        // Add namodg hidden field
        $html = "\t\t<input type='hidden' name='namodg_fields' value='" . self::_encrypt( serialize($this->_getFields()) ) . "'>" . PHP_EOL;
        
        // Close the div
        $html .= "\t</div>" . PHP_EOL;
        
        // Close the form
        $html .= '</form>' . PHP_EOL;
        
        return $html;
    }
    
    /**
     * Renders the form's HTML with it's fields
     * 
     * @return string
     */
    public function render() {
       
        // Form beginning tag
        $html = $this->getOpeningHTML();
                
        // Build fields
        foreach ( $this->_getFields() as $field ) {     
            if ( $field->getOption('label') ) {
                $labelHTML = "\t\t";
                $labelHTML .= '<label ' . ( $field->getOption('id') ? 'for="' . $field->getOption('id') . '"' : '' ) . ' >';
                $labelHTML .= $field->getOption('label');
                $labelHTML .= '</label>' . PHP_EOL;
                
                $html .= $labelHTML;
            }
            
            $html .= "\t\t" . $field->getHTML() . PHP_EOL . PHP_EOL;
        }
                
        // Close form html
        $html .= $this->getClosingHTML();
        
        return $html;
    }
    
    /**
     * All fields getter method
     * 
     * @return array
     */
    protected function _getFields() {
        return $this->_fields;
    }

    /**
     * Basic encryption method
     *
     * @param string $str
     * @return string
     */
    protected static function _encrypt($str){
      $result = '';      
      for($i=0, $length = strlen($str); $i<$length; $i++) {
         $char = substr($str, $i, 1);
         $keychar = substr(self::$_key, ($i % strlen(self::$_key))-1, 1);
         $char = chr(ord($char)+ord($keychar));
         $result.= $char;
      }
      return base64_encode($result);
    }
}
