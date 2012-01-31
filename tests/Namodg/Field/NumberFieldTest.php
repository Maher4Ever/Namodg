<?php

require_once 'tests/TestHelper.php';

class NumberFieldTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Field_NumberField(
      new Namodg_Validation_NumericArabicValidation,
      new Namodg_Renderer_FieldRenderer(
        new DOMDocument('1.0')
      ),
      'tel'
    );
  }

  public function testGettingSanitizedValues() {
    $this->subject->setValue('12345abcde');

    assertEquals('12345', $this->subject->getSanitizedValue());
  }

  public function testGettingHtml() {
    $this->subject->setValue('12345')
                  ->addValidation(new Namodg_Validation_RequiredValidation);

    assertEquals(
      '<input type="text" data-namodg-validation="number required" name="tel" value="12345">',
      $this->subject->getHtml()
    );
  }

}
