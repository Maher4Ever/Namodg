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
 * Namodg number field is used to reperesent
 * a HTML input with human-verification in PHP.
 *
 * @package Namodg
 * @subpackage Namodg_Field
 */
class Namodg_Field_CaptchaField extends Namodg_FieldAbstract {

  /**
   * Initialize the field.
   *
   * @param Namodg_Validation_RequiredValidation $requiredValidation
   * @param Namodg_Validation_CaptchaSimpleArabicValidation $captchaValidation
   * @param Namodg_Renderer_CaptchaFieldRenderer $renderer
   * @param string $id
   * @param array $metaData
   */
  public function __construct(
    Namodg_Validation_RequiredValidation $requiredValidation,
    Namodg_Validation_CaptchaSimpleArabicValidation $captchaValidation,
    Namodg_Renderer_CaptchaFieldRenderer $renderer,
    $id = NULL,
    array $metaData = array()
  ) {
    parent::__construct($renderer, $id, $metaData);
    $this->addValidation($requiredValidation)
         ->addValidation($captchaValidation)
         ->setMetaAttribute('send', FALSE);
    $renderer->setQuestion($captchaValidation->getQuestion());
  }

  /**
   * Returns a sanitized version of the value
   * which safely can be saved in a database.
   *
   * @return string
   */
  public function getSanitizedValue() {
    return filter_var($this->getValue(), FILTER_SANITIZE_NUMBER_INT);
  }

  /**
   * Returns the HTML markup of the field.
   *
   * @return string
   */
  public function getHTML() {
    $this->_getRenderer()->setAttribute('type', 'text')
                         ->addValidationRule('captcha');
    return parent::getHtml();
  }

}
