<?php

namespace Av\Library;


use Dotenv\Dotenv;

class Application
{
  private $router;

  public function __construct()
  {
    $this->bootstrap();
    $this->router = new Router();
  }

  /**
   * Enable PHP error reporting
   * @param bool $html
   */
  public function enableErrorReporting(bool $html = false): Application
  {
    ini_set("display_errors", 1);
    ini_set("error_reporting", 1);
    $html == true ? ini_set("html_errors", 1) : ini_set('html_errors', 0);
    return $this;
  }

  /**
   * Start listening to request
   */
  public function run()
  {
    try {

      $this->router->listen();
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  /**
   * Load environment variables
   * @return void
   */
  private function loadEnv()
  {
    (new Dotenv(__DIR__ . "/../configuration"))->load();
  }

  private function bootstrap(): Application
  {
    Container::set("klein", new \Klein\Klein());
    Container::set("translate", new Translator("es_DO"));

    $view = new \Av\Library\ViewManager();
    $view->setPath("/../view");
    $view->setExtension(".twig");
    $view->setPreFix("");
    $view->setCaching(__DIR__ . "/../cache");
    $view->setDI(Container::DI());
    Container::set("view", $view);
    return $this;
  }
}

