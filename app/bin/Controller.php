<?php
namespace Framework\Library;
use Framework\Library\Exception\UnknownParameter;
use Klein\DataCollection\DataCollection;
use Klein\Exceptions\UnhandledException;
use Pimple\Container;
/**
 *Controller base for every controller
 *
 * @author Denzyl<denzyl@live.nl>
 */
abstract class Controller
{

    private $controller;
    private $action;

    /**
     * @var \Klein\Response $response
     */
    protected $response;
    /**
     * @var \Klein\Request $request
     */
    protected $request;
    /**
     * @var Container $di
     */
    protected $di;

    /** @var  Render $view */
    protected $view;
    /** @var Translator $translator */
    protected $translator;

    /*
     * @param \Klein\Request $request
     * @param \Klein\Response $response
     * @param \Klein\ServiceProvider $service
     * @param \Framework\DI $di
     */
    public function __construct(Container $di)
    {
        /**
         * @var \Klein\Klein $klein
         */
        $klein = $di['klein'];
        $this->view = $di['viewManager'];
        $this->translator = $di['translate'];
        $this->request = $klein->request();
        $this->response = $klein->response();
        $this->di = $di;


    }

    /**
     * Get controller name
     *
     * @return string
     */
    public function getControllerName()
    {

        return str_replace("Framework\\\\", "", $this->controller);
    }

    /**
     * Get action name
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->action;
    }

    /**
     * Get parameter for a get request
     *
     * @param $key
     */
    public function get($key)
    {
        try{

            if (!empty($this->request->param($key)) ) {
                return $this->request->param($key);
            }else{
                $raw_params = $this->request->params();
                $clean_params = array();
                $params = array_filter(array_map("strtoupper", explode("/", $raw_params[0])));

                unset($params[0]);
                unset($params['controller']);
                unset($params['action']);


//                if (@$params[0] == strtoupper($this->getControllerName()) || $params[0] == strtoupper($this->getActionName())) {
//                    unset($params[0]);
//                }
//                if (@$params[1] == strtoupper($this->getActionName())) {
//                    unset($params[1]);
//                }


               // $tmp_array = array_map("strtolower", array_values($params));
                $tmp_array = $params;

//                for ($i=key(reset($params)); $i < count($tmp_array); $i = $i + 2) {
//
//
//                    if (array_key_exists($i + 1, $tmp_array)) {
//                        $clean_params[strtolower($tmp_array[$i])] = strtolower($tmp_array[$i + 1]);
//                    } else if (array_key_exists($i + 2, $tmp_array)) {
//
//                        break;
//                    }
//
//                }
                $clean_params = array();

                var_dump(array_values($params));
                foreach (array_values($params) as $p ) {
                    $clean_params[$p] = null;
                    var_dump(next($params   ));
                    if (isset($params[key($clean_params) + 1])) {


                        foreach ($params as $v) {
                            if ($v === $p ) {
                                $clean_params[$p] = $v;
                            }
                        }
                    }


                }
                \Kint::dump($clean_params);


                $dataCollection = new DataCollection($clean_params);
                return $dataCollection->get($key);

            }
        }catch (UnhandledException  $e)
        {
            throw new UnknownParameter($e);
        }

    }

    public function post()
    {
        return $this->request->paramsPost();
    }


    /**
     * @param $controller
     */
    public function setController($controller)
    {
        $this->controller = str_replace("Controller", "", $controller);
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = str_replace("Action", "", $action);
    }

    /**
     * Get cookie
     *
     * @return DataCollection
     */

    public function cookies()
    {

        return $this->request->cookies();

    }

    /**
     * Forward to another class
     * @param $resource
     * @throws \Exception
     */
    public function forward(array $resource)
    {

        $controller = $this->getResource($resource)[0];

        $action = $this->getResource($resource)[1];
        $parameters = $this->getResource($resource)[2];

        $instance = new $controller($this->di);
        if (method_exists($instance, "initialize")) {
            $instance->initialize();
        }

        $instance->setController($controller);
        $instance->setAction($action);
        $instance->$action($parameters);
    }

    /**
     * Extract the final path to client want's to be redirected/forwarded
     */
    private function getResource($resource)
    {
        $controller = null;
        $action = null;
        $params = array();
        if (!isset($resource["action"])) {
            $action = "IndexAction";
        } else if (isset($resource["action"]) && strlen($resource["action"]) > 0) {
            $action = $resource["action"];
        }

        if (isset($resource["controller"]) && strlen($resource["controller"]) > 0) {
            $controller = "Framework\Controller\\" . $resource["controller"];

        } else {
            throw new \Exception("Can't initiate an empty controller");
        }
        /**
         * unset the unused variables so we can't send the rest of the params;
         */
        unset($params["controller"]);
        unset($params["action"]);

        return array($controller, $action, $params);

    }

    /**
     * Redirect to new resource
     * @todo find a nicer way to redirect to url
     * Maybe use the http_* extension in php
     */
    public function redirect($resource)
    {
        $controller = $this->getResource($resource)[0];

        $action = $this->getResource($resource)[1];
        $parameters = $this->getResource($resource)[2];
        $location = $controller . "/" . $action;


        header("Location: {$location}");
    }

    public function render($file, array $params = null)
    {
        $params["di"] = $this->di;
        $params["translate"] = $this->translator;

       $this->view->render($this->getControllerName() . "/" . $file, $params);
    }
}
