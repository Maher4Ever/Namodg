<?php

require_once 'tests/TestHelper.php';

class CaptchaFieldRendererTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Renderer_CaptchaFieldRenderer(
      new DOMDocument('1.0')
    );
  }

  public function testRendererHasNoQuestionByDefault() {
    assertNull($this->subject->getQuestion());
  }

  public function testSettingAndGettingQuestion() {
    $this->subject->setQuestion('2 + 4');
    assertEquals('2 + 4', $this->subject->getQuestion());
  }

  public function testRenderingCaptchaFieldsWithoutQuestions() {
    assertEquals('<input>', $this->subject->render());
  }

  public function testRenderingCaptchaFieldsWithQuestions() {
    $this->subject->setQuestion('2 + 4');

    $result = <<<HTML
<p class="namodg-captcha-question">2 + 4</p>
<input>
HTML;

    assertEquals($this->_stripWhitespace($result), $this->subject->render());
  }

}
