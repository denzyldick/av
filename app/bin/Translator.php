<?php
namespace Framework\Library;

/**
 * A simple translation implementation.
 * @package Framework\Library
 * @author Denzyl Dick <denzyl@live.nl>
 */
class Translator
{

    private $lang;
    private $messages;

    public function __construct($lang = "nl-NL")
    {
        $this->lang = $lang;
        if (file_exists(__DIR__ . "/../messages/{$this->lang}.php")) {
            $this->messages = include_once(__DIR__ . "/../messages/{$this->lang}.php");
            foreach($this->messages as $key =>  $value)
            {
                $this->$key = $value;
            }
        } else {
            throw new \AVException("Can't translate because file doesn't exists.");
        }
    }

    /**
     * Change the locale
     * @param $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }
}