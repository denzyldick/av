<?php
/**
 * Created by PhpStorm.
 * User: denzyl
 * Date: 1/28/15
 * Time: 10:06 AM
 */

namespace Framework\Library;

/**
 * A simple translation implementation.
 * @package Framework\Library
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
        } else {
            throw new \RuntimeException("Can't translate because file doesn't exists.");
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

    /**
     * Get the translation of the given key
     * @param $key
     * @return mixed
     */
    public function getValue($key)
    {
        return $this->messages[$key];
    }

}