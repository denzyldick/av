<?php
namespace Av\Library;

/**
 * ViewManager
 * Class ViewManager
 * @package Av\Library
 */
class ViewManager
{
    private $path = null;
    private $extension = null;
    private $pre_fix = null;
    private $params = [];
    private $pimple;
    private $options;

    /**
     * Set an prefix for the file names
     * @param string $pre_fix
     * @return ViewManager
     */
    public function setPreFix(string $pre_fix):ViewManager
    {
        $this->pre_fix = $pre_fix;
        return $this;
    }


    public function setCaching($cache):ViewManager
    {
        $this->options['cache'] = $cache;
        return $this;
    }

    public function setDI($di):ViewManager
    {
        $this->pimple = $di;
        return $this;
    }

    /**
     * Check if the path is available
     * @return bool
     * @throws \Exception
     */
    private function isPath() : bool
    {
        if (is_null($this->path)) {
            throw new \Exception("There is no default path for the views");
        }
        return is_dir($this->path . Controller::getControllerName());
    }

    /**
     * Compile and send the twig file
     * @param string $file_name
     * @param array|null $params
     */
    public function render(string $file_name, array $params = null)
    {
        $params["DI"] = $this->pimple;
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem($this->path);

        $twig = new \Twig_Environment($loader,
            $this->options);
        $this->params = $params;
        $this->addParamsToObject();
        echo $twig->render("{$this->pre_fix}{$file_name}{$this->extension}", $params);
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
     * @param string $path
     * @return ViewManager
     */
    public function setPath(string $path):ViewManager
    {
        $this->path = __DIR__ . "/{$path}";
        return $this;
    }

    /**
     * @param string $extension
     * @return ViewManager
     */
    public function setExtension(string $extension):ViewManager
    {
        $this->extension = $extension;
        return $this;
    }
}
