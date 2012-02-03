<?php

require_once 'tests/TestHelper.php';

class EmailFieldTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Field_EmailField(
      new Namodg_Validation_EmailValidation,
      new Namodg_Renderer_FieldRenderer(
        new DOMDocument('1.0')
      )
    );
  }

  public function testGettingSanitizedValues() {
    $this->subject->setValue('emailتجربة@website.com');

    assertEquals('email@website.com', $this->subject->getSanitizedValue());
  }

  public function testGettingHtml() {
    $this->subject->setId('email')
                  ->setValue('email@website.com')
                  ->addValidation(new Namodg_Validation_RequiredValidation);

    assertEquals(
      '<input type="email" data-namodg-validation="email required" name="email" value="email@website.com">',
      $this->subject->getHtml()
    );
  }

}
