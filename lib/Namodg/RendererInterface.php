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
 * Set the rules for all renderers. 
 * 
 * @package Namodg
 * @subpackage Namodg_RendererInterface
 */
interface Namodg_RendererInterface {

    public function getTag();

    public function addAttr($id, $value);

    public function getAttr($id);

    public function render();
}
