<?php
/**
 *Framework bootstrap file
 * @author Denzyl Dick
 * @todo 1
 * @version 0.1
 */

	error_reporting(E_ALL);
	ini_set('display_errors',1);
/**
 * Include all services
 * */
include_once '../app/conf/services.php';
/**
 * Listen to all requests
 */
$router = new Framework\Library\Router($pimple);
$router->listen();
