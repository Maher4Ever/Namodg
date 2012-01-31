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
 * A field is a model for the data. Data can be assigned,
 * validated and retrieved.
 *
 * This interface defines the API for all Namodg fields.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
interface Namodg_FieldInterface {

  /**
   * Returns the unique identifier of the field.
   *
   * @return string
   */
  public function getId();

  /**
   * Set the value of the field.
   *
   * @param string $value
   */
  public function setValue($value);

  /**
   * Returns the value of the field
   * if it was set, otherwise a null.
   *
   * @return mixin
   */
  public function getValue();

  /**
   * Returns a sanitized version of the value
   * which safely can be saved in a database.
   *
   * @return string
   */
  public function getSanitizedValue();

  /**
   * Returns an escaped version of the value
   * which can safely be used inside HTML.
   * if the value is not set, an empty string
   * is returned.
   *
   * @return string
   */
  public function getHtmlSafeValue();

  /**
   * Returns the type of the field.
   *
   * @return string
   */
  public function getType();

  /**
   * Checks if the value is valid based
   * on the type of the field.
   *
   * @return boolean
   */
  public function isValueValid();

  /**
   * Returns the HTML markup of the field.
   *
   * @return string
   */
  public function getHtml();
}
