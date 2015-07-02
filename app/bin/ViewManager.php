<?php
/**
 * Created by PhpStorm.
 * User: denzyl
 * Date: 2/18/15
 * Time: 10:06 AM
 */

namespace Framework\Library;

/**
 * ViewManager
 * Class ViewManager
 * @package Framework\Library
 */
class ViewManager
{
    private $path = null;
    private $extension = null;
    private $pre_fix = null;
    private $params = [];
    private $translator;


    /**
     * @param null $pre_fix
     */
    public function setPreFix($pre_fix)
    {
        $this->pre_fix = $pre_fix;
    }

    /**
     * @param mixed $translator
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Check if the path is available
     * @return bool
     * @throws \Exception
     */
    private function isPath()
    {
        if (is_null($this->path)) {
            throw new \Exception("There is no default path for the views");
        }
        return is_dir($this->path);
    }

    /**
     * Render the view
     * @param $file_name
     * @throws \Exception
     */
    public function render($file_name, array $params = null)
    {
        $this->params = $params;
        $this->addParamsToObject();
        include($this->path . "/{$this->pre_fix}{$file_name}{$this->extension}");
    }

    /**
     * Add the parameters to this object.
     */
    private function addParamsToObject()
    {
        if (count($this->params) > 0) {
            foreach ($this->params as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param null $path
     */
    public function setPath($path)
    {
        $this->path = __DIR__ . "/{$path}";
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}
