
<?php

class Formaspgto extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarListaFormasPgto($empresa){
        $array = array();
        if(!empty($empresa)){
            $sqlA = "SELECT id, nome FROM formapgto WHERE  id_empresa = '$empresa' AND situacao='ativo'";
            $sqlA = $this->db->query($sqlA);
            if($sqlA->rowCount()>0){
                $array = $sqlA->fetchAll();
            }
        }
        return $array;
    }   
}
