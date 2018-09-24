
<?php

class Contasgerenciais extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarListaSinteticas($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sqlA = "SELECT id, nome FROM contasintetica WHERE movimentacao='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sqlA = $this->db->query($sqlA);
            if($sqlA->rowCount()>0){
                $sqlA = $sqlA->fetchAll();
                foreach ($sqlA as $chave => $valor){
                    $array[$chave] = array("id" => $valor["id"], "nome" => utf8_encode(ucwords($valor["nome"])));
                }   
            }
        }
        //print_r($array);exit;
        return $array;
    }
    
    public function pegarListaAnaliticas($idsintetica,$empresa){
        $array = array();
        if(!empty($idsintetica) && !empty($empresa)){
            $sqlA = "SELECT id, nome FROM contaanalitica WHERE id_sintetica='$idsintetica' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sqlA = $this->db->query($sqlA);
            if($sqlA->rowCount()>0){
                $sqlA = $sqlA->fetchAll();
                foreach ($sqlA as $chave => $valor){
                    $array[$chave] = array("id" => $valor["id"], "nome" => utf8_encode(ucwords($valor["nome"])));
                }   
            }
        }
        return $array;
    }    
}
