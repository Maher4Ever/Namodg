<?php

require_once 'tests/TestHelper.php';

class FieldRendererTest extends NamodgTestCase {

  protected $builderMock;

  public function setUp() {
    $this->builderMock = $this->getMockBuilder('DOMDocument')
                              ->setConstructorArgs(array( '1.0' ))
                              ->getMock();

    $this->subject = new Namodg_Renderer_FieldRenderer($this->builderMock, 'input');
  }

  public function testAddingOneValidationRule() {
    $this->subject->addValidationRule('required');

    assertEquals('required', $this->subject->getAttribute(
      Namodg_Renderer_FieldRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testAddingMultipleValidationRules() {
    $this->subject->addValidationRule('required')
                  ->addValidationRule('email');

    assertEquals('required email', $this->subject->getAttribute(
      Namodg_Renderer_FieldRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testRemovingValidationRules() {
    $this->subject->addValidationRule('required')
                  ->addValidationRule('email');

    $this->subject->removeValidationRule('required');

    assertEquals('email', $this->subject->getAttribute(
      Namodg_Renderer_FieldRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testClearingAllValidationRules() {
    $this->subject->addValidationRule('required')
                  ->addValidationRule('email');

    $this->subject->clearAllValidationRules();

    assertNull($this->subject->getAttribute(
      Namodg_Renderer_FieldRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testRendering() {
    $this->subject->setAttribute('title', 'test');

    $elemMock = $this->getMockBuilder('DOMElement')
                     ->setConstructorArgs(array( $this->subject->getTag() ))
                     ->getMock();

    $this->builderMock->expects($this->once())
                      ->method('createElement')
                      ->with($this->subject->getTag())
                      ->will($this->returnValue($elemMock));

    $elemMock->expects($this->once())
             ->method('setAttribute')
             ->with('title', 'test');

    $this->builderMock->expects($this->once())
                      ->method('appendChild')
                      ->with($elemMock);

    $this->builderMock->expects($this->once())
         ->method('saveHTML');

    $this->subject->render();
  }

  public function testRenderingInputs() {
    $renderer = new Namodg_Renderer_FieldRenderer(
      new DOMDocument('1.0')
    , 'input');

    $renderer->setAttribute('title', 'test');

    assertEquals(
      '<input title="test">'
    , $renderer->render());
  }
}
