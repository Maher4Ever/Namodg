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
 * Namodg Captcha Field, a human-verification field used to stop spam
 * 
 * @package Namodg
 */
class Namodg_Field_Captcha extends Namodg_FieldAbstract {

    private $_rand1 = NULL;
    private $_rand2 = NULL;

    public function __construct($name, $options = array()) {
        $this->_addDefaultOptions(array(
            'info' => NULL
        ));
        parent::__construct($name, $options);
        $this->_rand1 = mt_rand(1, 9);
        $this->_rand2 = mt_rand(1, 9);
        $this->setOption('required', true);
        $this->setOption('send', false);
    }

    public function isValid() {
        $value = trim($this->getValue());

        if (empty($value)) {
            $this->_setValidationError('required');
            return false;
        }

        if ( (int)$value !== $this->_getCaptchaAnswer() &&
             ! $this->_validateArabicNumber($value) 
           ) 
        {
            $this->_setValidationError('captcha_answer_wrong');
            return false;
        }

        return true;
    }

    public function getCleanedValue() {
        return filter_var( $this->getValue(), FILTER_SANITIZE_NUMBER_INT);
    }

    public function getHTML() {
        $field = new Namodg_Renderer_FieldRenderer('input', $this);
        $field->addAttr('type', 'text');
        $field->addValidationRule('captcha');

        $rands = $this->_getCaptchaQuestion();

        $return = '<p class="captcha-question"';
        $return .= ($this->getOption('id')) ? ' id="' . $this->getOption('id').  '-question"' : '';
        $return .= ($this->getOption('info')) ? ' title="' . $this->getOption('info').  '"' : '';
        $return .= '>';
        $return .= $rands[0] . ' + ' . $rands[1] . '</p>' . PHP_EOL;

        $return .= $field->render();

        return $return;
    }

    protected function _getCaptchaQuestion() {
        return array(
            $this->_rand1,
            $this->_rand2
        );
    }

    protected function _getCaptchaAnswer() {
        return $this->_rand1 + $this->_rand2;
    }

    private function _validateArabicNumber($arNum) {
        
        // Check if the passed value is actually an Arabic number
        if ( ! preg_match('/^[\x{0660}-\x{0669}]+$/u', $arNum) ) {
            return false;
        }
        
        $answer = (string)$this->_getCaptchaAnswer();
        $pattren = '';
        
        // Convert the answer from ASCCI to Unicode
        for($i = 0, $len = strlen($answer); $i < $len; $i++) {
            
            // Arabic zero in unicode = 0x0660 and Zero in ASCII = 48
            // Our base to convert: 660-48 = 612
            $pattren .= '\x{' . (ord($answer[$i]) + 612 ) . '}';
            
        }
        
        return preg_match('/^' . $pattren . '$/u', $arNum);
    }
}
