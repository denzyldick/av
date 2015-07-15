<?php

namespace Framework\Library;

use AVException as Exception;
use Framework\Controller\Index;
use Klein;
use Pimple\Container;


/**
 * With this router you can listen to all request and the initialize the controller
 *
 * @package Framework
 * @author  Denzyl<denzyl@live.nl>
 */
class Router
{
    /**
     * @var Klein\Klein $klein
     */
    private $klein;
    /**
     * @var Container
     */
    private $di;

    public function __construct(Container $di)
    {

        $this->klein = $di['klein'];
        $this->di = $di;

    }

    /**
     * Listen to  all requests
     * GET,POST,DELETE,HEAD
     */
    public function listen()
    {
        $this->klein->respond("/?/[:controller]?/?/[:action]?/?/[*:params]?", function ($request) {
            $this->initializeController(
                $request->param('controller', "index"),
                $request->param('action', 'index'),
                $request->param('params')
            );

        });
        $this->klein->dispatch();
    }

    /**
     * Initialize the controller with the corresponding action
     *
     * @param string $controllerParam
     * @param string $actionParam
     */
    private function initializeController($controllerParam = "index", $actionParam = "index")
    {
        $action = (strlen($actionParam) == 0 ? "index" : $actionParam);
        try {
            $concept_controller = "Framework\Controller\\" . ucfirst($controllerParam);
            $concept_action = "{$action}Action";

            if (class_exists($concept_controller)) {

                $instance = new $concept_controller($this->di);
            }else{
                $instance =  new Index($this->di);
            }

                $action = method_exists($instance, $concept_action) ? $concept_action : "indexAction";
                method_exists($instance, 'initialize') ? $instance->initialize() : "";
                $instance->setController(get_class($instance));
                $instance->setAction($action);
                $instance->$action();

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }


}
