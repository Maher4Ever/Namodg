<?php

require_once 'tests/TestHelper.php';

class TextareaTest extends NamodgTestCase {

  protected $renderer;

  public function setUp() {
    $this->renderer = new Namodg_Renderer_TextareaRenderer(
      new DOMDocument('1.0')
    );
    $this->subject = new Namodg_Field_Textarea($this->renderer, 'name');
  }

  public function testGettingSanitizedValues() {
    $this->subject->setValue('<h1>test</h1>');

    assertEquals(
      'test',
      $this->subject->getSanitizedValue()
    );
  }

  public function testGettingHtml() {
    $this->subject->setValue('<h1>Maher Sallam</h1>')
                  ->addValidation(new Namodg_Validation_RequiredValidation);

    $result = <<<HTML
<textarea name="name" data-namodg-validation="required">
  &amp;lt;h1&amp;gt;Maher Sallam&amp;lt;/h1&amp;gt;
</textarea>
HTML;

    assertEquals($this->_stripWhitespace($result), $this->subject->getHtml());
  }

}
