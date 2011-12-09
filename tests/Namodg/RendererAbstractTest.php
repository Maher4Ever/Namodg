<?php

require_once 'tests/TestHelper.php';

// Used to tests methods' expectations as PHPUnit can't do it
// with Abstract classes.
class Renderer extends Namodg_RendererAbstract {
  public function render() {}
}

class RendererAbstractTest extends NamodgTestCase {

  protected $builder;

  public function setUp() {
    $this->builder = $this->getMockBuilder('Renderer')
                          ->setConstructorArgs(array( 'input' ));

    $this->subject = $this->getMockBuilder('Namodg_RendererAbstract')
                          ->setConstructorArgs(array( 'input' ))
                          ->getMockForAbstractClass(); 
  }

  public function testConstructorSetsTag() {
    assertAttributeEquals('input', '_tag', $this->subject);
  }

  public function testGettingTag() {
    assertEquals('input', $this->subject->getTag());
  }

  public function testAddingAttributes() {
    $this->subject->addAttr('title', 'my-input');
    $attrs = PHPUnit_Framework_Assert::readAttribute($this->subject, '_attrs');

    assertArrayHasKey('title', $attrs);
    assertEquals('my-input', $attrs['title']); 
  }

  public function testAddingIdAsAttrCallsTheIdAddingMethod() {
    $mock =$this->builder->setMethods(array( 'setID' ))
                         ->getMock();

    $mock->expects($this->once())
         ->method('setID');
    
    $mock->addAttr('id', 'my-input');
  }

  public function testAddingClassAsAttrCallsTheClassAddingMethod() {
    $mock =$this->builder->setMethods(array( 'addClass' ))
                         ->getMock();

    $mock->expects($this->once())
         ->method('addClass');

    $mock->addAttr('class', 'highlight');
  }
}
