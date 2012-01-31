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
 * The renderer of Namodg captcha fields. It is designed
 * to simplify the creation of Namodg captcha fields by
 * providing an adequate API for rendering their data.
 *
 * @package Namodg
 * @subpackage Namodg_Renderer
 */
class Namodg_Renderer_CaptchaFieldRenderer extends Namodg_Renderer_FieldRenderer {

  /**
   * The tag used for the HTML element
   * that contains the captcha question.
   */
  const QUESTION_ELEMENT_TAG = 'p';

  /**
   * The name of the class applied to the HTML element
   * that contains the captcha question. This class
   * can act as a selector on the client-side.
   */
  const QUESTION_ELEMENT_CLASS = 'namodg-captcha-question';

  /**
   * The captcha question which will be
   * rendered with the field if it has been set.
   *
   * @var string
   */
  private $_question = NULL;

  /**
   * Sets the captcha question.
   *
   * @var string $question
   */
  public function setQuestion($question) {
    $this->_question = $question;
    return $this;
  }

  /**
   * Returns the captcha question.
   *
   * @return string
   */
  public function getQuestion() {
    return $this->_question;
  }

  /**
   * Renders the field's HTML
   *
   * @return string
   */
  public function render() {

    if ( $question = $this->getQuestion() ) {
      $questionElement = $this->_getBuilder()->createElement(self::QUESTION_ELEMENT_TAG);
      $questionElement->setAttribute('class', self::QUESTION_ELEMENT_CLASS);
      $questionElement->appendChild($this->_getBuilder()->createTextNode($question));
      $this->_getBuilder()->appendChild($questionElement);
    }

    return parent::render();
  }

}
