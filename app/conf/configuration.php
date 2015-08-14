<?php
/**
 * Configuration file
 */
$configuration = (object)array(
    "base" => "/",
    "mysql"=>(object)array(
      "host"=>"localhost",
       "user"=>"root",
       "password"=>'123',
       "database"=>"framework",
       "pdo_driver"=>"mysql"
    ),
    "view" => (object)array(
        "path" => "../view",
        "extension" => ".twig",
        "pre_fix" => "",
        "cache"=>false
    )
);
return $configuration;
