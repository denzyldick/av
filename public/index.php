<?php
$loader = require __DIR__ . "/../vendor/autoload.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

$av = new Av\Library\Application();
$av->run();
