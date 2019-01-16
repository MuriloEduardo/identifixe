<?php

class Unidades extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarLista() {
       $array = array();
       $arrayAux = array();
       
       $sql = "SELECT id, unidades FROM unidades WHERE situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $arrayAux = $sql->fetchAll(); 
       }
       foreach ($arrayAux as $chave => $valor){
        $array[$chave] = array( "id" => $valor["id"], 
                                "nome" => utf8_encode(ucwords($valor["unidades"]))); 
        }        
       return $array; 
    }    
}