<?php

require_once 'tests/TestHelper.php';

class FieldRendererTest extends NamodgTestCase {

  protected $builderMock;

  public function setUp() {
    $this->builderMock = $this->getMockBuilder('DOMDocument')
                              ->setConstructorArgs(array( '1.0' ))
                              ->getMock();

    $this->subject = new Namodg_Renderer_FieldRenderer($this->builderMock);
  }

  public function testThatContentIsTheSameAsTheValueAttribueForField() {
    $this->subject->setContent('my data');

    assertEquals($this->subject->getAttribute('value'), $this->subject->getContent());
  }

  public function testThatClearingContentClearsTheValueAttribute() {
    $this->subject->setContent('my data');
    $this->subject->clearContent();

    assertNull($this->subject->getAttribute('value'));
  }

  public function testRenderingInputs() {
    $renderer = new Namodg_Renderer_FieldRenderer(
      new DOMDocument('1.0')
    );

    $renderer->addValidationRule('required')
             ->setId('name')
             ->setContent('Maher Sallam');

    assertEquals(
      '<input data-namodg-validation="required" id="name" value="Maher Sallam">'
    , $renderer->render());
  }
}
