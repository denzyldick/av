<?php


/*
* All services
* Design Pattern = Dependency Injection
*/

use Framework\Library\Container;
use Framework\Library\Exception\AVException;
use Framework\Library\Translator;

include __DIR__ . "/../conf/configuration.php";

Container::set("klein", new \Klein\Klein());
Container::set("translate", new Translator("es_DO"));

$view = new \Framework\Library\ViewManager();
$view->setPath($configuration->view->path);
$view->setExtension($configuration->view->extension);
$view->setPreFix($configuration->view->pre_fix);
$view->setCaching($configuration->view->cache);
$view->setDI(Container::DI());
Container::set("viewManager", $view);


try {
    $pdo = new PDO("{$configuration->mysql->pdo_driver}:host={$configuration->mysql->host};dbname={$configuration->mysql->database}", $configuration->mysql->user, $configuration->mysql->password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    Container::set("pdo", $pdo);

} catch (PDOException $e) {
    throw new AVException($e);
}

