<?php
/**
 * Configuration file
 */
$configuration = (object)array(
    "base" => "/",
    "view" => (object)array(
        "path" => "view",
        "extension" => ".twig",
        "pre_fix" => "",
        "cache"=>false
    )
);
return $configuration;
