<?php
namespace Framework\Library;
/**
 * Simple Tanslator class
 * @package Framework\Library
 */
class Translator
{
    public function __construct($lang)
    {
        $file = __DIR__."/../messages/{$lang}.php";

        if(file_exists($file))
        {
            $messages = include($file);
            foreach ($messages as $key => $value ) {
                $this->$key = $value;
            }

        }

    }
}