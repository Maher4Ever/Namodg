<?php

require_once 'tests/TestHelper.php';

class EmailValidationTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Validation_EmailValidation;
  }

  public function testThatValuesAreGettingCheckedForValidateability() {
    $mock = $this->getMockBuilder('Namodg_Validation_EmailValidation')
                 ->setMethods(array( 'isValidateable' ))
                 ->getMock();

    $value = 'test';

    $mock->expects($this->once())
         ->method('isValidateable')
         ->with($value);

    $mock->isValid($value);
  }

  public function testValidatingWrongEmailsFail() {
    $badEmails = array(
      '@web.com', 'name@', 'blig$bling@no_way.com'
    );

    foreach($badEmails as $email) {
      assertFalse($this->subject->isValid($email));
    }
  }

  public function testValidatingGoodEmailsSucceed() {
    assertTrue($this->subject->isValid('maher@sallam.me'));
  }

  public function testItReturnsMessage() {
    assertEquals('email_not_valid', $this->subject->getMessage());
  }

}
