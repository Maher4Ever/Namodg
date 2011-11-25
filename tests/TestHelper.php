<?php

// Autoload namodg libs
function autoload_namodg_lib($lib) {
  $path = 'lib/' . str_replace('_', '/', $lib) . '.php';
  if ( file_exists($path) ) {
    require_once $path;
  }
}
spl_autoload_register('autoload_namodg_lib');
