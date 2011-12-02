<?php

// Autoload namodg libs
function autoload_namodg_lib($lib) {
  $path = 'lib/' . str_replace('_', '/', $lib) . '.php';
  if ( file_exists($path) ) {
    require_once $path;
  }
}
spl_autoload_register('autoload_namodg_lib');

// Load the assertion function to reduce the use of $this in tests
require_once 'PHPUnit/Framework/Assert/Functions.php';

// Extend the standard test-case
class NamodgTestCase extends  PHPUnit_Framework_Testcase {}
