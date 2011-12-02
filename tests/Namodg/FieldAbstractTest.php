<?php

require_once 'tests/TestHelper.php';

class FieldAbstractTest extends NamodgTestCase {
  
  protected $field;

  protected function setUp() {
    $this->field = $this->getMockForAbstractClass('Namodg_FieldAbstract');
  }

  public function testConstructorAutoGeneratesNameWhenPassedNone() {
    assertAttributeNotEmpty('_name', $this->field);
  }

  public function testConstructorAutoGeneratesNameWhenPassedEmptyOne() {
    $stub = $this->getMockBuilder('Namodg_FieldAbstract')
                 ->setConstructorArgs(array( '' ))
                 ->getMockForAbstractClass();

    assertAttributeNotEmpty('_name', $this->field);
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
      ), '_options', $this->field);
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
    $this->field->setValue('my-value');
    
    assertAttributeEquals('my-value', '_value', $this->field);
  }
  
  public function testGettingValueWorks() {
    $this->field->setValue('my-value');
    
    assertEquals('my-value', $this->field->getValue());
  }

  public function testSettingOptionWorks() {
    $this->field->setOption('my-option', 'field-1');
    $options = PHPUnit_Framework_Assert::readAttribute($this->field, '_options');

    assertArrayHasKey('my-option', $options);
    assertEquals('field-1', $options['my-option']);
  }

  public function testSettingValidationErrorWorks() {
    $reflection = new ReflectionClass('Namodg_FieldAbstract');
    $method = $reflection->getMethod('_setValidationError');
    $method->setAccessible(true);

    $method->invokeArgs($this->field, array('my-error'));

    assertAttributeEquals('my-error', '_validatonError', $this->field);
  }

  public function testGettingValidationErrorWorks() {
    $reflection = new ReflectionClass('Namodg_FieldAbstract');
    $method = $reflection->getMethod('_setValidationError');
    $method->setAccessible(true);

    $method->invokeArgs($this->field, array('my-error'));

    assertEquals('my-error', $this->field->getValidationError());
  }
}
