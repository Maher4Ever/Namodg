<?php

require_once 'tests/TestHelper.php';

class RequiredValidationTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Validation_RequiredValidation;
  }

  public function testThatValuesAreGettingCheckedForValidateability() {
    $mock = $this->getMockBuilder('Namodg_Validation_RequiredValidation')
                 ->setMethods(array( 'isValidateable' ))
                 ->getMock();

    $value = 'test';

    $mock->expects($this->once())
         ->method('isValidateable')
         ->with($value);

    $mock->isValid($value);
  }

  public function testValidatingEmptyStringFails() {
    assertFalse($this->subject->isValid(''));
  }

  public function testValidingStringWithSpacesOnlyFalis() {
    assertFalse($this->subject->isValid('   '));
  }

  public function testValidatingNormalStringSucceeds() {
    assertTrue($this->subject->isValid('test'));
  }

  public function testItReturnsMessage() {
    assertEquals('required', $this->subject->getMessage());
  }

}
