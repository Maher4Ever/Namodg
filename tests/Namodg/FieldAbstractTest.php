<?php

require_once 'tests/TestHelper.php';

class FieldAbstractTest extends PHPUnit_Framework_Testcase {
  
  protected $field;

  protected function setUp() {
    $this->field = $this->getMockForAbstractClass('Namodg_FieldAbstract');
  }

  public function testFieldAbstractConstructorAutoGeneratesName() {
    $this->assertNotEmpty($this->field->getName());
  }
}
