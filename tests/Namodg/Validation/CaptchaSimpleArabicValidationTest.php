<?php

require_once 'tests/TestHelper.php';

class CaptchaSimpleArabicValidationTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Validation_CaptchaSimpleArabicValidation;
  }

  public function testThatValuesAreGettingCheckedForValidateability() {
    $mock = $this->getMockBuilder('Namodg_Validation_CaptchaSimpleArabicValidation')
                 ->setMethods(array( 'isValidateable' ))
                 ->getMock();

    $value = 'test';

    $mock->expects($this->once())
         ->method('isValidateable')
         ->with($value);

    $mock->isValid($value);
  }

  public function testValidatingAnythingButTheRightAnswerFail() {
    assertFalse($this->subject->isValid(rand()));
  }

  public function testValidatingTheRightAnswerSucceed() {
    $mock = $this->getMockBuilder('Namodg_Validation_CaptchaSimpleArabicValidation')
                 ->setMethods(array( '_getAnswer' ))
                 ->getMock();

    $mock->expects($this->any())
         ->method('_getAnswer')
         ->will($this->returnValue('15'));

    assertTrue($mock->isValid('15'));
  }

  public function testValidatingTheRightAnswerInArabicSucceed() {
    $mock = $this->getMockBuilder('Namodg_Validation_CaptchaSimpleArabicValidation')
                 ->setMethods(array( '_getAnswer' ))
                 ->getMock();

    $mock->expects($this->any())
         ->method('_getAnswer')
         ->will($this->returnValue('15'));

    // Hack the validation and regenerate the pattren (ugly... I know)
    $reflection = new ReflectionClass('Namodg_Validation_CaptchaSimpleArabicValidation');
    $method = $reflection->getMethod('_generatePattren');
    $method->setAccessible(true);

    $method->invoke($mock);

    assertTrue($mock->isValid('١٥'));
  }

  public function testGettingTheQuestion() {
    assertStringMatchesFormat('%i + %i', $this->subject->getQuestion());
  }

  public function testItReturnsMessage() {
    assertEquals('captcha_answer_wrong', $this->subject->getMessage());
  }

}
