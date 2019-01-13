<?php
require "environment.php";

global $config;
$config = array();

if(ENVIRONMENT == "development"){
    
    $config["dbname"] = "identifixe";
    $config["dbhost"] = "127.0.0.1";
    $config["dbuser"] = "root";
    $config["dbpass"] = "lilo0202";
    
}else{
    
    $config["dbname"] = "u372331304_teste";
    $config["dbhost"] = "mysql.hostinger.com.br";
    $config["dbuser"] = "u372331304_teste";
    $config["dbpass"] = "testesqualo";
    
}

?>

