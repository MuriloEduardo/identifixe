<?php

class Produtos extends model {
    

    public function __construct($id = "") {
        parent::__construct(); 
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

    public function adicionar($request) {
        var_dump($request);exit;
    }

    public function adicionarOld($camposAdd, $dadosTabela){

        if(count($camposAdd) > 0 && !empty($dadosTabela)){
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";

            //tratamento das informações vindas do formulário e montagem da query
            $campos = Array();
            $sql = "INSERT INTO produtos(id, ";
            $sqlA = "( DEFAULT, ";

            for($i = 1; $i <= count($camposAdd); $i++){
                $nomecoluna = lcfirst($dadosTabela[$i]['nomecol']);

                if(strpos($dadosTabela[$i]['tipo'], "varchar") !== false){
                    
                    $campos[$i] = trim(addslashes($camposAdd[$i]));

                }elseif(strpos($dadosTabela[$i]['tipo'], "float") !== false){
                    
                    $campos[$i] = floatval(str_replace(",",".",str_replace(".","",addslashes($camposAdd[$i]))));    

                }elseif(strpos($dadosTabela[$i]['tipo'], "date") !== false){

                    //tratamento da variavel se for data
                    $dtaux = explode("/",addslashes($camposAdd[$i]));
                    $campos[$i] = $dtaux[2]."-".$dtaux[1]."-".$dtaux[0];
                }else{

                    $campos[$i] = trim(addslashes($camposAdd[$i]));
                }

                $sql = $sql."$nomecoluna, ";
                $sqlA = $sqlA."'".$campos[$i]."', ";

            }   
            
            $sql = $sql."alteracoes, situacao) VALUES ".$sqlA. "'$alteracoes', 'ativo')";
            $this->db->query($sql);

        }
    }    
    
     public function pegarInfo($id) {
        $array = array();
        $arrayAux = array();

        $sql = "SELECT * FROM produtos WHERE id='$id' AND situacao = 'ativo'";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(); 
        }
        foreach ($arrayAux as $chave => $valor){
            $array[$chave] = array(utf8_encode($valor));        
        }
        return $array; 
    }
    
     public function editar($camposAdd,$dadosTabela, $id){
        if(!empty($id) && !empty($camposAdd) && count($dadosTabela) > 0 ){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $hist =  explode("##", addslashes($camposAdd[count($camposAdd)]));
            
            if(!empty($hist[1])){
                $alteracoes = $hist[0]." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO >> ".$hist[1];     
            }else{
                $alteracoes = '';
            }
            
            //tratamento das informações vindas do formulário e montagem da query
            $campos = Array();
            $sql = "UPDATE produtos SET ";
            $sqlA = "( DEFAULT, ";

            for($i = 1; $i <= count($camposAdd); $i++){
                $nomecoluna = lcfirst($dadosTabela[$i]['nomecol']);

                if(strpos($dadosTabela[$i]['tipo'], "varchar") !== false){
                    
                    $campos[$i] = trim(addslashes($camposAdd[$i]));

                }elseif(strpos($dadosTabela[$i]['tipo'], "float") !== false){
                    
                    $campos[$i] = floatval(str_replace(",",".",str_replace(".","",addslashes($camposAdd[$i]))));    

                }elseif(strpos($dadosTabela[$i]['tipo'], "date") !== false){

                    //tratamento da variavel se for data
                    $dtaux = explode("/",addslashes($camposAdd[$i]));
                    $campos[$i] = $dtaux[2]."-".$dtaux[1]."-".$dtaux[0];
                }else{

                    $campos[$i] = trim(addslashes($camposAdd[$i]));
                }
                
                if(!empty($alteracoes)){
                    if($i < count($camposAdd)){
                        $sql = $sql."$nomecoluna = '$campos[$i]', ";
                    }else{
                        $sql = $sql."$nomecoluna = '$alteracoes' ";
                    }
                }    
            }   

            if(!empty($alteracoes)){
                $sql = $sql." WHERE id = '$id'";
                $this->db->query($sql);   
            }    
        }
    }
    
    public function excluir($id){
        if(!empty($id)){
            
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM produtos WHERE id = '$id' AND situacao = 'ativo'";
            
            $sql = $this->db->query($sql);
            
            if($sql->rowCount() > 0){  
               $sql = $sql->fetch();
               $palter = $sql["alteracoes"];
               $p = new Permissoes();
               $ipcliente = $p->pegaIPcliente();

               $palter = $palter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
               
               $sqlA = "UPDATE produtos SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id' ";
               $this->db->query($sqlA);
               
            }
        }
    }
    
}
