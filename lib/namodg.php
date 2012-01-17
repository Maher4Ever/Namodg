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

// Set include path
set_include_path(dirname( __FILE__ ) . PATH_SEPARATOR . get_include_path());

// Load Namodg utility class
require dirname(__FILE__) . '/classes/Namodg.php';

// Regester Namodg components autoloader
Namodg::registerAutoload();
