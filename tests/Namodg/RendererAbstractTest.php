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

  public function testGettingTag() {
    assertEquals('input', $this->subject->getTag());
  }

  public function testSettingAndGettingAttributes() {
    $this->subject->setAttribute('title', 'my input');

    assertEquals($this->subject->getAttribute('title'), 'my input');
  }

  public function testAddingIdAsAttrCallsTheIdAddingMethod() {
    $mock =$this->builder->setMethods(array( 'setId' ))
                         ->getMock();

    $mock->expects($this->once())
         ->method('setId');

    $mock->setAttribute('id', 'my-input');
  }

  public function testAddingClassAsAttrCallsTheClassAddingMethod() {
    $mock =$this->builder->setMethods(array( 'addClass' ))
                         ->getMock();

    $mock->expects($this->once())
         ->method('addClass');

    $mock->setAttribute('class', 'highlight');
  }

  public function testGettingAllAttrs() {
    $this->subject->setAttribute('title', 'my input')
                  ->setId('my-input')
                  ->addClass('highlight');

    $attrs = $this->subject->getAllAttributes();

    assertEquals($attrs['title'], 'my input');
    assertEquals($attrs['id'], 'my-input');
    assertEquals($attrs['class'], 'highlight');
  }

  public function testRemovingAttributes() {
    $this->subject->setAttribute('title', 'my input');
    $this->subject->removeAttribute('title');

    assertNull($this->subject->getAttribute('title'));
  }

  public function testClearingAllAttributes() {
    $this->subject->setAttribute('title', 'my input')
                  ->setId('my-input')
                  ->addClass('highlight');

    $this->subject->clearAllAttributes();

    assertEmpty($this->subject->getAllAttributes());
  }

  public function testSettingAndGettingContent() {
    $this->subject->setContent('my data');

    assertEquals($this->subject->getContent(), 'my data');
  }

  public function testClearingContent() {
    $this->subject->setContent('my data');
    $this->subject->clearContent();

    assertNull($this->subject->getContent());
  }

  public function testSettingId() {
    $this->subject->setId('my-input');

    assertEquals('my-input',$this->subject->getAttribute('id'));
  }

  public function testAddingClassesWhenNoClassesAreAlreadyAdded() {
    $this->subject->addClass('highlight');

    assertEquals('highlight', $this->subject->getAttribute('class'));
  }

  public function testAddingClassesWhenClassesAreAlreadyAdded() {
    $this->subject->addClass('highlight');
    $this->subject->addClass('grid_3');

    assertEquals('highlight grid_3', $this->subject->getAttribute('class'));
  }
}
