<?php

require_once 'tests/TestHelper.php';

class CaptchaFieldTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Field_CaptchaField(
      new Namodg_Validation_RequiredValidation,
      new Namodg_Validation_CaptchaSimpleArabicValidation,
      new Namodg_Renderer_CaptchaFieldRenderer(
        new DOMDocument('1.0')
      ),
      'captcha'
    );
  }

  public function testThatCaptchaFieldShouldNotBeSentByDefault() {
    assertFalse($this->subject->getMetaAttribute('send'));
  }

  public function testGettingSanitizedValues() {
    $this->subject->setValue('<span>7</span>');

    assertEquals('7', $this->subject->getSanitizedValue());
  }

  public function testGettingHtml() {
    $this->subject->setValue('7');

    $result = <<<HTML
<p class="namodg-captcha-question">%d + %d</p>
<input type="text" data-namodg-validation="captcha required" name="captcha" value="7">
HTML;

    assertStringMatchesFormat($this->_stripWhitespace($result), $this->subject->getHtml());
  }

}
