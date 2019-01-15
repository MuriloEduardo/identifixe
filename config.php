<?php
require "environment.php";

global $config;
$config = array();

if(ENVIRONMENT == "development"){
    
    $config["dbname"] = "mmotos";
    $config["dbhost"] = "127.0.0.1";
    $config["dbuser"] = "root";
    $config["dbpass"] = "";
    
}else{
    
    $config["dbname"] = "u372331304_teste";
    $config["dbhost"] = "mysql.hostinger.com.br";
    $config["dbuser"] = "u372331304_teste";
    $config["dbpass"] = "testesqualo";
    
}

?>

