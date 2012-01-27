<?php

require_once 'tests/TestHelper.php';

class SelectListRendererTest extends NamodgTestCase {

  public function setUp() {
    $this->subject = new Namodg_Renderer_SelectListRenderer(
      new DOMDocument('1.0'), 'input'
    );
  }

  public function testAddingOptions() {
    $this->subject->addOption('my option');

    assertContains('my option', $this->subject->getAllOptions());
  }

  public function testRemovingOptions() {
    $this->subject->addOption('my option');
    $this->subject->removeOption('my option');

    assertNotContains('my option', $this->subject->getAllOptions());
  }

  public function testSettingAndGettingDefaultOption() {
    $this->subject->setDefaultOption('default option');

    assertEquals('default option', $this->subject->getDefaultOption());
  }

  public function testClearingDefaultOption() {
    $this->subject->setDefaultOption('default option');
    $this->subject->clearDefaultOption();

    assertNull($this->subject->getDefaultOption());
  }

  public function testSettingAndGettingSelectedOption() {
    $this->subject->setSelectedOption('chosen option');

    assertEquals('chosen option', $this->subject->getSelectedOption());
  }

  public function testClearingSelectedOption() {
    $this->subject->setSelectedOption('chosen option');
    $this->subject->clearSelectedOption();

    assertNull($this->subject->getSelectedOption());
  }

  public function testGettingAllOptions() {
    $this->subject->addOption('my option');
    $this->subject->setSelectedOption('chosen option');

    $options = $this->subject->getAllOptions();

    assertEquals(2, count($options));
    assertContains('my option', $options);
    assertContains('chosen option', $options);
  }

  public function testGettingAllOptionsWithTheSameOptionAndSelectedOption() {
    $this->subject->addOption('my option');
    $this->subject->setSelectedOption('my option');

    $options = $this->subject->getAllOptions();

    assertEquals(1, count($options));
    assertContains('my option', $options);
  }

  public function testRenderingWithoutOptions() {
    $this->subject->setID('dropdown');

    assertEquals('<select id="dropdown"></select>', $this->subject->render());
  }

  public function testRenderingWithOptions() {
    $this->subject->setID('dropdown')
                  ->addOption('test')
                  ->addOption('not test')
                  ->setDefaultOption('please select one')
                  ->setSelectedOption('test');

    $result = <<<HTML
<select id="dropdown">
  <option>please select one</option>
  <option value="test" selected>test</option>
  <option value="not test">not test</option>
</select>
HTML;

    assertEquals(preg_replace('/(>)[ \n\t]+/', '\1', $result), $this->subject->render());
  }
}
