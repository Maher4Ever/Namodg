<?php

require_once 'tests/TestHelper.php';

class TagRendererTest extends NamodgTestCase {

  protected $builderMock;

  public function setUp() {
    $this->builderMock = $this->getMockBuilder('DOMDocument')
                              ->setConstructorArgs(array( '1.0' ))
                              ->getMock();

    $this->subject = new Namodg_Renderer_TagRenderer($this->builderMock, 'p');
  }

  public function testAddingOneValidationRule() {
    $this->subject->addValidationRule('required');

    assertEquals('required', $this->subject->getAttribute(
      Namodg_Renderer_TagRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testAddingMultipleValidationRules() {
    $this->subject->addValidationRule('required')
                  ->addValidationRule('email');

    assertEquals('required email', $this->subject->getAttribute(
      Namodg_Renderer_TagRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testRemovingValidationRules() {
    $this->subject->addValidationRule('required')
                  ->addValidationRule('email');

    $this->subject->removeValidationRule('required');

    assertEquals('email', $this->subject->getAttribute(
      Namodg_Renderer_TagRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testClearingAllValidationRules() {
    $this->subject->addValidationRule('required')
                  ->addValidationRule('email');

    $this->subject->clearAllValidationRules();

    assertNull($this->subject->getAttribute(
      Namodg_Renderer_TagRenderer::VALIDATION_ATTRUBUTE
    ));
  }

  public function testRenderingCallsChain() {
    $this->subject->setAttribute('title', 'test')
                  ->setContent('my data');

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

    $textNodeMock = $this->getMockBuilder('DOMText')
                         ->setConstructorArgs(array( $this->subject->getContent() ))
                         ->getMock();

    $this->builderMock->expects($this->once())
                      ->method('createTextNode')
                      ->with($this->subject->getContent())
                      ->will($this->returnValue($textNodeMock));

    $elemMock->expects($this->once())
             ->method('appendChild')
             ->with($textNodeMock);

    $this->builderMock->expects($this->once())
         ->method('saveHTML');

    $this->subject->render();
  }

  public function testRenderingTags() {
    $renderer = new Namodg_Renderer_TagRenderer(
      new DOMDocument('1.0')
    , 'p');

    $renderer->setAttribute('title', 'test')
             ->setContent('my data')
             ->addClass('highlight');

    assertEquals(
      '<p title="test" class="highlight">my data</p>'
    , $renderer->render());
  }
}
