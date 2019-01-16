<?php

class Categorias extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarLista() {
        $array = array();
        $arrayAux = array();
        
        $sql = "SELECT id, categorias FROM categorias WHERE situacao = 'ativo'";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
          $arrayAux = $sql->fetchAll(); 
        }
        foreach ($arrayAux as $chave => $valor){
         $array[$chave] = array( "id" => $valor["id"], 
                                 "nome" => utf8_encode(ucwords($valor["categorias"]))); 
         }        
        return $array; 
     }    
}