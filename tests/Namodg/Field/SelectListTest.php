<?php

require_once 'tests/TestHelper.php';

class SelectListTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Field_SelectList(
      new Namodg_Renderer_SelectListRenderer(
        new DOMDocument('1.0')
      )
    );
  }

  public function testGettingSanitizedValues() {
    $this->subject->setValue('<h1>test</h1>');

    assertEquals(
      'test',
      $this->subject->getSanitizedValue()
    );
  }

  public function testGettingHtml() {
    $this->subject->setId('rate')
                  ->setValue('5 stars')
                  ->addValidation(new Namodg_Validation_RequiredValidation);

    $result = <<<HTML
<select name="rate" data-namodg-validation="required">
  <option value="5 stars" selected>5 stars</option>
</select>
HTML;

    assertEquals($this->_stripWhitespace($result), $this->subject->getHtml());
  }

}
