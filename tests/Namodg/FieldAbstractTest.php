<?php

require_once 'tests/TestHelper.php';

class FieldAbstractTest extends NamodgTestCase {

  protected $rendererMock;

  protected $fieldBuilder;

  protected function setUp() {
    $this->rendererMock = $this->getMockBuilder('Namodg_Renderer_FieldRenderer')
                               ->setConstructorArgs(array(
                                 new DOMDocument('1.0'), 'input'
                               ))
                               ->getMock();

    $this->fieldBuilder = $this->getMockBuilder('Namodg_FieldAbstract');

    $this->subject = $this->fieldBuilder
                          ->setConstructorArgs(array( $this->rendererMock ))
                          ->getMockForAbstractClass();
  }

  public function testConstructorAutoGeneratesIdWhenPassedNone() {
    assertNotEmpty($this->subject->getId());
  }

  public function testConstructorSetsNameWhenPassedOne() {
    $stub = $this->_mockFieldWithId('email');
    assertEquals('email', $stub->getId());
  }

  public function testConstructorSetsDefaultMetaDataWhenPassedNone() {
    assertEquals(array(
      'required' => FALSE,
      'send'     => TRUE
    ), $this->subject->getMetaData());
  }

  public function testConstructorSetsMetaDataWhenPassedOne() {
    $meta = array(
      'required' => TRUE,
      'send'     => FALSE
    );

    $stub = $this->_mockFieldWithMeta($meta);

    assertEquals($meta, $stub->getMetaData());
  }

  public function testSettingAndGettingValues() {
    $this->subject->setValue('my-value');

    assertEquals('my-value', $this->subject->getValue());
  }

  public function testGettingType() {
    $stub = $this->fieldBuilder
                 ->setMockClassName('Namodg_Field_TextField')
                 ->getMockForAbstractClass();

    assertEquals('textfield', $stub->getType());
  }

  public function testSettingAndGettingMetaAttributes() {
    $this->subject->setMetaAttribute('important', 'yes');

    assertEquals('yes', $this->subject->getMetaAttribute('important'));
  }

  public function testAbstractFieldsHaveNoValidationsByDefault() {
    assertEmpty($this->subject->getAllValidations());
  }

  public function testThatTheValueIsValidByDefault() {
    assertTrue($this->subject->isValueValid());
  }

  public function testAddingAndGettingValidations() {
    $validation = new Namodg_Validation_RequiredValidation;
    $this->subject->addValidation($validation);

    assertContains($validation, $this->subject->getAllValidations());
  }

  public function testValidatingTheValueUsingValidations() {
    $this->subject->addValidation(new Namodg_Validation_RequiredValidation);

    assertFalse($this->subject->isValueValid());

    $this->subject->setValue('test');

    assertTrue($this->subject->isValueValid());
  }

  public function testWhenValidationsFailTheErrorGetsSet() {
    $this->subject->addValidation(new Namodg_Validation_RequiredValidation)
                  ->addValidation(new Namodg_Validation_EmailValidation)
                  ->isValueValid();

    assertEquals('required', $this->subject->getValidationError());

    $this->subject->setValue('not an email')
                  ->isValueValid();

    assertEquals('email_not_valid', $this->subject->getValidationError());
  }

  public function testSettingAndGettingValidationError() {
    $reflection = new ReflectionClass('Namodg_FieldAbstract');
    $method = $reflection->getMethod('_setValidationError');
    $method->setAccessible(true);

    $method->invokeArgs($this->subject, array('my-error'));

    assertEquals('my-error', $this->subject->getValidationError());
  }

  public function testGettingHtml() {
    $this->subject->setMetaAttribute('required', true);

    $this->rendererMock->expects($this->once())
                       ->method('setAttribute')
                       ->with('name', $this->subject->getId());

    $this->rendererMock->expects($this->once())
                       ->method('addValidationRule')
                       ->with('required');

    $this->subject->getHtml();
  }

  private function _mockFieldWithId($id) {
    return $this->fieldBuilder
                ->setConstructorArgs(array( $this->rendererMock, $id ))
                ->getMockForAbstractClass();
  }

  private function _mockFieldWithMeta($meta) {
    return $this->fieldBuilder
                ->setConstructorArgs(array( $this->rendererMock, NULL, $meta ))
                ->getMockForAbstractClass();
  }
}
