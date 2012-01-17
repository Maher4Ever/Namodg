<?php

require_once 'tests/TestHelper.php';

class FieldAbstractTest extends NamodgTestCase {

  protected function setUp() {
    $this->subject = $this->getMockForAbstractClass('Namodg_FieldAbstract');
  }

  public function testConstructorAutoGeneratesNameWhenPassedNone() {
    assertAttributeNotEmpty('_name', $this->subject);
  }

  public function testConstructorAutoGeneratesNameWhenPassedEmptyOne() {
    $stub = $this->getMockBuilder('Namodg_FieldAbstract')
                 ->setConstructorArgs(array( '' ))
                 ->getMockForAbstractClass();

    assertAttributeNotEmpty('_name', $this->subject);
  }

  public function testConstructorSetsNameWhenPassedOne() {
    $stub = $this->getMockBuilder('Namodg_FieldAbstract')
                 ->setConstructorArgs(array( 'email' ))
                 ->getMockForAbstractClass();

    assertAttributeEquals('email', '_name', $stub);
  }

  public function testUsingDefaultOptionsWhenPassedNone() {
    assertAttributeEquals(array(
        'id' => NULL,
        'class' => NULL,
        'required' => FALSE,
        'label' => NULL,
        'title' => NULL,
        'send' => TRUE
      ), '_options', $this->subject);
  }

  public function testUsingPasseOptionsWhenPassedSome() {
    $options = array(
      'id' => 'field-1',
      'class' => 'field grid-4'
    );

    $stub = $this->getMockBuilder('Namodg_FieldAbstract')
                 ->setConstructorArgs(array(NULL, $options))
                 ->getMockForAbstractClass();

    assertAttributeEquals(array(
        'id' => 'field-1',
        'class' => 'field grid-4',
        'required' => FALSE,
        'label' => NULL,
        'title' => NULL,
        'send' => TRUE
      ), '_options', $stub);
  }

  public function testGettingNameWorks() {
    $stub = $this->getMockBuilder('Namodg_FieldAbstract')
                 ->setConstructorArgs(array( 'email' ))
                 ->getMockForAbstractClass();

    assertEquals('email', $stub->getName());
  }

  public function testSettingValueWorks() {
    $this->subject->setValue('my-value');

    assertAttributeEquals('my-value', '_value', $this->subject);
  }

  public function testGettingValueWorks() {
    $this->subject->setValue('my-value');

    assertEquals('my-value', $this->subject->getValue());
  }

  public function testGettingTypeWorks() {
    $stub = $this->getMockBuilder('Namodg_FieldAbstract')
                 ->setMockClassName('Namodg_Field_TextField')
                 ->getMockForAbstractClass();

    assertEquals('textfield', $stub->getType());
  }

  public function testSettingOptionWorks() {
    $this->subject->setOption('my-option', 'field-1');
    $options = PHPUnit_Framework_Assert::readAttribute($this->subject, '_options');

    assertArrayHasKey('my-option', $options);
    assertEquals('field-1', $options['my-option']);
  }

  public function testSettingValidationErrorWorks() {
    $reflection = new ReflectionClass('Namodg_FieldAbstract');
    $method = $reflection->getMethod('_setValidationError');
    $method->setAccessible(true);

    $method->invokeArgs($this->subject, array('my-error'));

    assertAttributeEquals('my-error', '_validatonError', $this->subject);
  }

  public function testGettingValidationErrorWorks() {
    $reflection = new ReflectionClass('Namodg_FieldAbstract');
    $method = $reflection->getMethod('_setValidationError');
    $method->setAccessible(true);

    $method->invokeArgs($this->subject, array('my-error'));

    assertEquals('my-error', $this->subject->getValidationError());
  }
}
