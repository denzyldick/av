<?php


/*
* All services
* Design Pattern = Dependency Injection
*/

include __DIR__ . "/../conf/configuration.php";


/**
 * Initiate a Pimple Container
 */
$pimple = new \Pimple\Container();

/**
 * Klein
 *
 */
$pimple['klein'] = function () {
    return new \Klein\Klein();
};

/***
 * Swift mail
 */
$pimple["mailer"] = function () use ($configuration) {

    $transport = Swift_SmtpTransport::newInstance($configuration->smtp->host, $configuration->smtp->port, 'ssl')
        ->setUsername($configuration->smtp->username)
        ->setPassword($configuration->smtp->password);
    return new \Framework\Library\Emailer($transport);
};
/**
 * Translator
 *
 * @return Framework\Library\Translator
 */
$pimple["translate"] = function () {
    return new \Framework\Library\Translator('en-US');
};
/**
 * This is the default view manager
 * @return \Framework\Library\ViewManager
 */
$pimple['viewManager'] = function () use ($configuration, $pimple) {
    $view = new \Framework\Library\ViewManager();
    $view->setPath($configuration->view->path);
    $view->setExtension($configuration->view->extension);
    $view->setPreFix($configuration->view->pre_fix);
    $view->setCaching($configuration->view->cache);
    $view->setDI($pimple);
    return $view;
};


/**
 *
 */
$pimple['mandango'] = function() use ($configuration)
{
    //$mandango = new Mandango\Mondator\
};
/**
 * @return null|PDO
 * @throws \Framework\Library\Exception\AVException
 */
$pimple['pdo'] = function() use ($configuration)
{
    try{
        return new PDO("{$configuration->mysql->pdo_driver}:host={$configuration->mysql->host};dbname={$configuration->mysql->database}");

    }catch(PDOException $e)
    {
        throw new \Framework\Library\Exception\AVException($e);
    }finally{
        return null;
    }

};
/**
 * Container
 */

$container = new \Framework\Library\Container($pimple);