<?php

/**
 * Namodg - Form Generator
 * ========================
 *
 * Namodg is a class which allows to easily create, render, validate and process forms
 *
 * @author Maher Sallam <admin@namodg.com>
 * @link http://namodg.com
 * @copyright Copyright (c) 2010-2011, Maher Sallam
 *
 * Dual licensed under the MIT and GPL licenses:
 *   @license http://www.opensource.org/licenses/mit-license.php
 *   @license http://www.gnu.org/licenses/gpl.html
 */

/**
 * Namodg Exception
 *
 * This is a special exception, because it can provide a string explaning the error if asked to.
 *
 * @package Namodg
 */
class Namodg_NamodgException extends Exception {

    public function getError() {
        $errors = array(
            'no_key' => 'No key is passed to namodg.',
            'weak_key' => 'The key must be at least 10 characters long.',
            'method_not_valid' => 'The method configuration must be one of two values: POST or GET.'
        );

        return in_array($this->getMessage(), array_flip($errors)) ? $errors [ $this->getMessage() ] : $this->getMessage();
    }

}
