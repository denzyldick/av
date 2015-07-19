<?php
/**
 * Configuration file
 */
$configuration = (object)array(
    "base" => "/",
    "mysql"=>(object)array(
      "host"=>"localhost",
       "user"=>"root",
       "password"=>'password',
       "database"=>"framework"
    ),
    "view" => (object)array(
        "path" => "../view",
        "extension" => ".twig",
        "pre_fix" => "",
        "cache"=>false
    )
);
return $configuration;
