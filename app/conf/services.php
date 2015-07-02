<?php


/*
*All services
* Design Pattern = Dependency Injection
*/
$loader = require __DIR__ . "/../../vendor/autoload.php";

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
    return new \Framework\Library\Translator();
};
/**
 * This is the default view manager
 * @return \Framework\Library\ViewManager
 */
$pimple['viewManager'] = function () use ($configuration, $pimple) {
    $view = new \Framework\Library\ViewManager();
    $view->setTranslator($pimple['translate']);
    $view->setPath($configuration->view->path);
    $view->setExtension($configuration->view->extension);
    $view->setPreFix($configuration->view->pre_fix);
    return $view;
};


/**
 * Doctrine 2 configuration
 * @return EntityManager
 * @throws \Doctrine\ORM\ORMException
 */
$pimple["entityManager"] = function () use ($configuration) {

   $config = Setup::createAnnotationMetadataConfiguration(array("model"), true);
   $driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(new \Doctrine\Common\Annotations\AnnotationReader(), array("model"));

   /*
    * Registering annotation - all annotation is allowed.
    */
   \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
   $config->setMetadataDriverImpl($driver);
   $entityManager = EntityManager::create(
       (array)$configuration->mysql, $config
   );
   /** @var $entityManager \Doctrine\ORM\EntityManager */
   $platform = $entityManager->getConnection()->getDatabasePlatform();
   $platform->registerDoctrineTypeMapping('enum', 'string');
   return $entityManager;
};
