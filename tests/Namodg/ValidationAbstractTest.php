<?php

require_once 'tests/TestHelper.php';

class ValidationAbstractTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = $this->getMockForAbstractClass('Namodg_ValidationAbstract');
  }

  public function testValidatingNullFails() {
    assertFalse($this->subject->isValidateable(NULL));
  }

  public function testValidatingArrayFail() {
    assertFalse($this->subject->isValidateable(array('test')));
  }

  public function testValidatingEmptyStringSucceeds() {
    assertTrue($this->subject->isValidateable(''));
  }

  public function testSettingAndGettingMessage() {
    $reflection = new ReflectionClass('Namodg_ValidationAbstract');
    $method = $reflection->getMethod('_setMessage');
    $method->setAccessible(true);

    $method->invokeArgs($this->subject, array('required'));

    assertEquals('required', $this->subject->getMessage());
  }

}
