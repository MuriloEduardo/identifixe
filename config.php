<?php
require "environment.php";

global $config;
$config = array();

if(ENVIRONMENT == "development") {
    $config["db"] = "identifixe";
    $config["host"] = "127.0.0.1";
    $config["user"] = "root";
    $config["pass"] = "";
} else {
    $config["db"] = "u372331304_teste";
    $config["host"] = "mysql.hostinger.com.br";
    $config["user"] = "u372331304_teste";
    $config["pass"] = "testesqualo";
}

?>