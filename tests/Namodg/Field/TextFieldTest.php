<?php

require_once 'tests/TestHelper.php';

class TextFieldTest extends NamodgTestCase {

  protected $renderer;

  public function setUp() {
    $this->renderer = new Namodg_Renderer_FieldRenderer(
      new DOMDocument('1.0')
    );
    $this->subject = new Namodg_Field_TextField($this->renderer);
  }

  public function testGettingSanitizedValues() {
    $this->subject->setValue('<h1>test</h1>');

    assertEquals(
      'test',
      $this->subject->getSanitizedValue()
    );
  }

  public function testGettingHtml() {
    $this->subject->setId('name')
                  ->setValue('Maher Sallam')
                  ->addValidation(new Namodg_Validation_RequiredValidation);

    assertEquals(
      '<input type="text" name="name" value="Maher Sallam" data-namodg-validation="required">',
      $this->subject->getHtml()
    );
  }

}
