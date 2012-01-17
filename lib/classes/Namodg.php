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
 * The main utility class of Namodg. It should not be instantiated.
 *
 * @package Namodg
 */
abstract class Namodg {

  /**
   * Namodg current version
   */
  const VERSION = '1.4';

  /**
   *  Registers an autoloader for Namodg components.
   */
  public static function registerAutoload() {
    spl_autoload_register(array('Namodg', '_autoload'));
  }

  /**
   * Autoloads Namodg classes if they are not already loaded.
   */
  private static function _autoload($component) {
    if ( strpos($component, 'Namodg') !== 0) {
      return;
    }

    $path = str_replace('_', DIRECTORY_SEPARATOR, $component) . '.php';
    require $path;
  }

}
