<?php
namespace Framework\Library\View;
use bin\View\Levels;

/**
 * Render
 * Class Render
 * @package Framework\Library
 */
class Render
{
    private $path = null;
    private $extension = null;
    private $pre_fix = null;
    private $params = [];
    private $pimple;
    private $options;


    /**
     * @param null $pre_fix
     */
    public function setPreFix($pre_fix)
    {
        $this->pre_fix = $pre_fix;
    }


    public function setCaching($cache)
    {
        $this->options['cache'] = $cache;
    }

    public function setDI($pimple)
    {
        $this->pimple = $pimple;
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
        return is_dir($this->path . ControllerBase::getControllerName());
    }
    public function setLevel(Levels $level)
    {
        $this->level = $level;
    }
    /**
     * Load the view with twig
     * @param $file_name
     * @param array $params
     */
    public function render($file_name, array $params = null)
    {
        $params["DI"] = $this->pimple;

        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem(__DIR__."/../../".$this->path);

        $twig = new \Twig_Environment($loader,
            $this->options);
        $this->params = $params;
        $this->addParamsToObject();
        echo $twig->render(strtolower("{$this->pre_fix}{$file_name}{$this->extension}"), $params);
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
        $this->path = "{$path}";
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}
