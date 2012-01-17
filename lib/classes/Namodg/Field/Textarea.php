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
 * Namodg Textarea, used for multi-line string data
 *
 * @package Namodg
 */
class Namodg_Field_Textarea extends Namodg_Field_TextField {

    public function getHTML() {
        $field = new Namodg_Renderer_FieldRenderer('textarea', $this);
        return $field->render();
    }

}
