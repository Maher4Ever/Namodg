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
 * Set the rules for all Namodg fields. This ensures all Namodg needs will be met from the extensions, but doesn't
 * ensure the returned value.
 * 
 * @package Namodg
 */
interface Namodg_FieldInterface {
    
    /**
     * This should return the name of the the data-holder
     * 
     * @return string
     */
    public function getName();
    
    /**
     * This should allow the change the data value
     * 
     * @param mixin
     */
    public function setValue($value);
    
    /**
     * This should return the orignial data value
     * 
     * @return mixin
     */
    public function getValue();

    /**
     * This shuold return an escaped and cleaned data value
     * 
     * @return mixin
     */
    public function getCleanedValue();
   
    /**
     * This should return the type of the data
     * 
     * @return string
     */
    public function getType();
    
    /**
     * This should return a boolean indicating the status of the data
     * 
     * @return boolean
     */
    public function isValid();
    
    /**
     * This should return the value inside a HTML tag
     * 
     * @return string
     */
    public function getHTML();
}
