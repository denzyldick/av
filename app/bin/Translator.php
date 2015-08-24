<?php
namespace Framework\Library\Translator;

class Translator
{
    public function __construct($lang)
    {
        $file = __DIR__."/messages/{$lang}.php";
        if(file_exists($file))
        {
            $messages = file_get_contents($file);
            var_dump($messages);
        }
    }
}