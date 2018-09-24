<?php

class controller {
    protected $db;
    public function __construct() {
        global $config;
//        try{
//            $this->db = new PDO("mysql:dbname=".$config["dbname"].";host=".$config["dbhost"].";",$config["dbuser"],$config["dbpass"]);
//        } catch (PDOException $e){
//            echo "FALHA : ".$e->getMessage()."<br/> Entre em contato com o administrador do sistema.";
//        }
    }
    
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include "views/".$viewName.".php";
    }  
    
    public function loadTemplate($viewName, $viewData = array()) {
        extract($viewData);
        include "views/template.php";
    }
    
    public function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        include "views/".$viewName.".php";
    }
    
    public function loadLibrary($lib) {
        if(file_exists("libraries/".$lib.".php")){
            include "libraries/".$lib.".php";
        }
    }
    
}
