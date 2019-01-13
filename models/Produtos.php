<?php

class Produtos extends model {
    

    public function __construct($id = "") {
        parent::__construct(); 
    }
     
//    
    public function nomeDasColunas(){
       $array = array();
       
       $sql = "SHOW COLUMNS FROM produtos";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $sql = $sql->fetchAll(); 
         foreach ($sql as $chave => $valor){
            $array[$chave] = array( "nomecol" => utf8_encode(ucwords($valor["Field"])), 
                                    "tipo" => $valor["Type"], 
                                    "nulo" => $valor["Null"], 
                                    "relacional" => array() );        
         }
       }
       for($i=0; $i < count($array); $i++){
           $model = '';
           $lista = array();
           if($array[$i]['tipo'] == 'mediumtext'){
               
              $model =  ucfirst($array[$i]['nomecol'])."s";
              $a = new $model();
              $lista = $a->pegarLista();
              $array[$i]['relacional'] = $lista;
           }
       }
       return $array;
    }
    
    public function pegarListaProdutos() {
       $array = array();
       
       $sql = "SELECT * FROM produtos WHERE situacao = 'ativo' ORDER BY id DESC";      
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

    public function adicionar($camposAdd,$dadosTabela){
        // print_r($camposAdd); exit;
        //echo "aqui4";exit;
        if(count($camposAdd) > 0 && !empty($dadosTabela)){
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";
                   
            //echo $camposAdd[7]; exit;

            //tratamento das informações vindas do formulário e montagem da query
            $campos = Array();
            $sql = "INSERT INTO produtos(id, ";
            $sqlA = "( DEFAULT, ";

            for($i = 1; $i <= count($camposAdd); $i++){
                $nomecoluna = lcfirst($dadosTabela[$i]['nomecol']);

                if(strpos($dadosTabela[$i]['tipo'], "varchar") !== false){
                    
                    $campos[$i] = trim(addslashes($camposAdd[$i]));

                }elseif(strpos($dadosTabela[$i]['tipo'], "float") !== false){
                    //if(strpos(addslashes($camposAdd[$i]), "%") !== false){    
                        
                    //}
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
       //print_r($array); exit; 
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
