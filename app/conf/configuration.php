<?php
/**
 * Every global configuration should be listed here! So we can change it every time we
 * want too.
 */

$configuration = (object)array(
    "base" => "/",
    "mysql" => (object)array(
        "host" => "localhost",
        "database" => "datbase",
        "driver" => "pdo_mysql",
        "user" => "root",
        "password" => "password"
    ),
    "smtp" => (object)array(
        "host" => "",
        "username" => "",
        "password" => "",
        "port" => ""
    ),
    "modelsDir" => "../app/model",
    "libraryDir" => "../bin"
,
    "view" => (object)array(
        "path" => "../view",
        "extension" => ".twig",
        "pre_fix" => ""
    )
);
return $configuration;
