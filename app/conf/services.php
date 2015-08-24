<?php


/*
* All services
* Design Pattern = Dependency Injection
*/

use Framework\Library\Container;
use Framework\Library\Exception\AVException;
use Framework\Library\Translator\Translator;

include __DIR__ . "/../conf/configuration.php";


Container::set("klein",function () : \Klein\Klein {
    return new \Klein\Klein();
});

/**
 * Translator
 *
 * @return Framework\Library\Translator
 */
Container::set("tranlate",function(){
   return new Translator("es_DO");
});
Container::set("viewManager",function () use ($configuration) : \Framework\Library\ViewManager{
    $view = new \Framework\Library\ViewManager();
    $view->setPath($configuration->view->path);
    $view->setExtension($configuration->view->extension);
    $view->setPreFix($configuration->view->pre_fix);
    $view->setCaching($configuration->view->cache);
    $view->setDI(Container::DI());
    return $view;
});
Container::set("pdo", function() use ($configuration) : PDO
{
    try{
        $pdo = new PDO("{$configuration->mysql->pdo_driver}:host={$configuration->mysql->host};dbname={$configuration->mysql->database}",$configuration->mysql->user,$configuration->mysql->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    }catch(PDOException $e)
    {
        throw new AVException($e);
    }

});