<?php

require_once 'tests/TestHelper.php';

class TextareaRendererTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Renderer_TextareaRenderer (
      new DOMDocument('1.0')
    );
  }

  public function testRenderingTextareas() {
    $this->subject->addValidationRule('required')
                  ->setId('name')
                  ->setContent('Maher Sallam');

    $result = <<<HTML
<textarea data-namodg-validation="required" id="name">
  Maher Sallam
</textarea>
HTML;

    assertEquals($this->_stripWhitespace($result), $this->subject->render());
  }

}
