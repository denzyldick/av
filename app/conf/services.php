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
$pimple['klein'] = function () : \Klein\Klein {
    return new \Klein\Klein();
};

/***
 * Swift mail
 */
$pimple["mailer"] = function () use ($configuration) : Emailer {

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
$pimple["translate"] = function () : \Framework\Library\Translator{
    return new \Framework\Library\Translator('en-US');
};
/**
 * This is the default view manager
 * @return \Framework\Library\ViewManager
 */
$pimple['viewManager'] = function () use ($configuration, $pimple) : \Framework\Library\ViewManager{
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
$pimple['pdo'] = function() use ($configuration) : PDO
{
    try{
        $pdo = new PDO("{$configuration->mysql->pdo_driver}:host={$configuration->mysql->host};dbname={$configuration->mysql->database}",$configuration->mysql->user,$configuration->mysql->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    }catch(PDOException $e)
    {
        throw new \Framework\Library\Exception\AVException($e);
    }

};
/**
 * Container
 */

$container = new \Framework\Library\Container($pimple);