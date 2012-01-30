<?php

require_once 'tests/TestHelper.php';

class NumericValidationTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Validation_NumericValidation;
  }

  public function testThatValuesAreGettingCheckedForValidateability() {
    $mock = $this->getMockBuilder('Namodg_Validation_NumericValidation')
                 ->setMethods(array( 'isValidateable' ))
                 ->getMock();

    $value = 'test';

    $mock->expects($this->once())
         ->method('isValidateable')
         ->with($value);

    $mock->isValid($value);
  }

  public function testValidatingAnythingButNumbersFail() {
    $bad = array(
      'good@email.com', 'string', '8e10', 15 // 15 is not '15'!
    );

    foreach($bad as $thing) {
      assertFalse($this->subject->isValid($thing));
    }
  }

  public function testValidatingNumbersSucceed() {
    assertTrue($this->subject->isValid('15'));
  }

  public function testItReturnsMessage() {
    assertEquals('not_numeric', $this->subject->getMessage());
  }

}
