<?php
/**
 * Command $ php vendor/bin/doctrine

 */
require_once 'app/conf/services.php';
/*
 * @var entity_manager EntityManager
 */
$em = $pimple['entityManager'];
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'entity_manager' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));