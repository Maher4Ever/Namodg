<?php

require_once 'tests/TestHelper.php';

class SubmitButtonTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Field_SubmitButton(
      new Namodg_Renderer_FieldRenderer(
        new DOMDocument('1.0')
      ),
      'send',
      'Submit the form'
    );
  }

  public function testConstructorSetsValueWhenPassedOne() {
    assertEquals('Submit the form', $this->subject->getValue());
  }

  public function testThatCaptchaFieldShouldNotBeSentByDefault() {
    assertFalse($this->subject->getMetaAttribute('send'));
  }

  public function testExceptionIsThrownWhenAddingValidations() {
    $this->setExpectedException('BadMethodCallException');
    $this->subject->addValidation(new Namodg_Validation_RequiredValidation);
  }

  public function testExceptionIsThrownWhenGettingAllValidations() {
    $this->setExpectedException('BadMethodCallException');
    $this->subject->getAllValidations();
  }

  public function testThatSubmitButtonIsAlwaysValid() {
    assertTrue($this->subject->isValueValid());
  }

  public function testGettingHtml() {
    assertEquals(
      '<input type="submit" name="send" value="Submit the form">',
      $this->subject->getHtml()
    );
  }

}
