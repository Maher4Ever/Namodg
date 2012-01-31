<?php

// Autoload namodg libs
require dirname(__FILE__) . '/../lib/namodg_init.php';

// Load the assertion function to reduce the use of $this in tests
require_once 'PHPUnit/Framework/Assert/Functions.php';

// Extend the standard test-case
class NamodgTestCase extends  PHPUnit_Framework_Testcase {
  protected $subject;

  /**
   * Strips whitespace between html tags
   * while retaining content between them.
   *
   * @return string
   */
  protected function _stripWhitespace($html) {
    return preg_replace('/>\s*(\S.*\S)\s*</', '>\1<', $html);
  }
}
