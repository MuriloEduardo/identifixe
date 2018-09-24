
<?php

class Unidades extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarListaUnidades($empresa) {
       $array = array();
       
       $sql = "SELECT id, unidade FROM unidades WHERE id_empresa = '$empresa' AND situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }    
}
