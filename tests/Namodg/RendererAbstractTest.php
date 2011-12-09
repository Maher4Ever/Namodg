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

  public function testGettingAttrs() {
    $this->subject->addAttr('title', 'my input');

    assertEquals($this->subject->getAttr('title'), 'my input');
  }

  public function testGettingAllAttrs() {
    $this->subject->addAttr('title', 'my input')
                  ->setID('my-input')
                  ->addClass('highlight');

    $attrs = $this->subject->getAllAttrs();

    assertArrayHasKey('title', $attrs);
    assertArrayHasKey('id', $attrs);
    assertArrayHasKey('class', $attrs);

    assertEquals($attrs['title'], 'my input');
    assertEquals($attrs['id'], 'my-input');
    assertEquals($attrs['class'], 'highlight');
  }

  public function testSettingID() {
    $this->subject->setID('my-input');
    $attrs = PHPUnit_Framework_Assert::readAttribute($this->subject, '_attrs');

    assertArrayHasKey('id', $attrs);
    assertEquals('my-input', $attrs['id']);  
  }

  public function testAddingClassesWhenNoClassesAreAlreadyAdded() {
    $this->subject->addClass('highlight');
    $attrs = PHPUnit_Framework_Assert::readAttribute($this->subject, '_attrs');

    assertArrayHasKey('class', $attrs);
    assertEquals('highlight', $attrs['class']);     
  }

  public function testAddingClassesWhenClassesAreAlreadyAdded() {
    $this->subject->addClass('highlight');
    $this->subject->addClass('grid_3');
    $attrs = PHPUnit_Framework_Assert::readAttribute($this->subject, '_attrs');

    assertEquals('highlight grid_3', $attrs['class']);     
  }
}
