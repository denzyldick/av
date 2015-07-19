<?php
/**
 * Run framework
 */
$loader = require __DIR__ . "/../vendor/autoload.php";

$av = new Framework\Library\AV();
$av->run();