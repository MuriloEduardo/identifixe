<?php
class model{
    
    protected $db;
    public function __construct() {
        global $config;
        try{
            $this->db = new PDO("mysql:dbname=".$config["db"].";host=".$config["host"].";",$config["user"],$config["pass"]);
        } catch (PDOException $e){
             echo "FALHA : ".$e->getMessage()."<br/> Entre em contato com o administrador do sistema.";
        }
    }
}

?>
