
<?php

class Contascorrentes extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarListaCC($empresa) {
       $array = array();
       
       $sql = "SELECT id, nome FROM contascorrentes WHERE id_empresa = '$empresa' AND situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }    
}
