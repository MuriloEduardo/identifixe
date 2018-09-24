<?php

class Servicos extends model {
    

    public function __construct($id = "") {
        parent::__construct(); 
    }
     
//    
    public function nomeDasColunas(){
       $array = array();
       
       $sql = "SHOW COLUMNS FROM servicos";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $sql = $sql->fetchAll(); 
         foreach ($sql as $chave => $valor){
            $array[$chave] = array("nomecol" => utf8_encode(ucwords($valor["Field"])), "tipo" => $valor["Type"]);        
         }
       }
//       print_r($array);exit;
       return $array;
    }
    
    public function pegarListaServicos($empresa) {
       $array = array();
       
       $sql = "SELECT * FROM servicos WHERE id_empresa = '$empresa' AND situacao = 'ativo' ORDER BY id DESC";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    
    public function buscaServicoPeloNome($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT nome FROM servicos WHERE nome='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }

    public function adicionar($txts,$empresa){
        
        if(count($txts) > 0 && !empty($empresa)){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";
                   
            
            //tratamento das informações vindas do formulário
            $txt1 =      trim(addslashes($txts[1])); // nome
            $txt2 =           addslashes($txts[2]); // preço
            $txt2 =  str_replace(".","",$txt2);
            $txt2 = floatval(str_replace(",",".",$txt2));
            //echo "$txt2";            exit();
            $txt3 =      trim(addslashes($txts[3])); // obs   
            //montagem da query
            $sql = "INSERT INTO servicos(id, id_empresa, nome, preco, observacao, alteracoes, situacao) VALUES ".
             
            "(DEFAULT, ".
            "'$empresa', ".
            "'$txt1', ".
            "'$txt2', ".
            "'$txt3', ".
            "'$alteracoes', ".
            "'ativo')";
            //echo "$sql";            exit();
            $this->db->query($sql);

        }
    }    
    
     public function pegarInfoServico($id,$empresa) {
       $array = array();
       
       $sql = "SELECT * FROM servicos WHERE id='$id' AND id_empresa = '$empresa' AND situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    
     public function editar($id, $txts, $empresa){
        if(!empty($id) && !empty($empresa) && count($txts) >0 ){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            //$altera = addslashes($txts[21])." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
            
            //tratamento das informações vindas do formulário
            $txt1 =      trim(addslashes($txts[1])); // nome
            $txt2 =           addslashes($txts[2]); // preço
            $txt2 =  str_replace(".","",$txt2);
            $txt2 = floatval(str_replace(",",".",$txt2));
            //echo "$txt2";            exit();
            $txt3 =      trim(addslashes($txts[3])); // obs                       
            $altera = "$txts[4] | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
            
            
            //montagem da query
            $sql = "UPDATE servicos SET ".
                "nome       =    '$txt1', ".
                "preco      =    '$txt2', ".
                "observacao =    '$txt3', ".
                "alteracoes = '$altera' WHERE id = '$id' AND id_empresa = '$empresa'";
            
            $this->db->query($sql);

        }
    }
    
    public function excluir($id,$empresa){
        if(!empty($id) && !empty($empresa)){
            
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM servicos WHERE id = '$id' AND id_empresa = '$empresa' AND situacao = 'ativo'";
            
            $sql = $this->db->query($sql);
            
            if($sql->rowCount() > 0){  
               $sql = $sql->fetch();
               $palter = $sql["alteracoes"];
               $p = new Permissoes();
               $ipcliente = $p->pegaIPcliente();

               $palter = $palter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
               
               $sqlA = "UPDATE servicos SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id' AND id_empresa = '$empresa'";
               $this->db->query($sqlA);
               
            }
        }
    }
    
}
