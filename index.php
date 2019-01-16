<?php
session_start();
require_once 'config.php';
define("BASE_URL", "http://localhost/identifixe");
define("NOME_EMPRESA", "Identifixe");

    spl_autoload_register(function($class){
        if (strpos($class, "Controller") > -1){
        if(file_exists("controllers/".$class.".php")){
            require_once "controllers/".$class.".php";  
        }
        }
        else if(file_exists("models/".$class.".php")){
            require_once "models/".$class.".php";
        }
        else if(file_exists("core/".$class.".php")){
            require_once "core/".$class.".php";
        }
        
    });

    $core = new core();
    $core->run();
    ?>