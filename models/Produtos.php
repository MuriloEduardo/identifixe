<?php

class Produtos extends model {
    

    public function __construct($id = "") {
        parent::__construct(); 
    }

    public function unico($table, $campo, $valor) {
        $array = array();
        $sql = "SELECT * FROM $table WHERE $campo = '$valor' AND situacao = 'ativo'";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(); 
        }
        return $array;
    }
     
    // função para preencher o json da tabela de produtos
    
    public function buscaProdutos1(){
        $dbtable = 'produtos';

        $sql = "SHOW COLUMNS FROM $dbtable";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
          $sql = $sql->fetchAll(); 
          foreach ($sql as $chave => $valor){
             $array[$chave] = array( "nomecol" => utf8_encode(ucwords($valor["Field"])));                                      
          }
        }

        $meioQuery = '';
        for($i=1; $i < count($array)-2; $i++){
            //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
            if($i = count($array)-2){
                $meioQuery = $meioQuery.$array[$i]['nomecol']; 
            }else{
                $meioQuery = $meioQuery.$array[$i]['nomecol'].","; 
            }
            
        }      

        //Receber a requisão da pesquisa 
        $requestData = $_REQUEST;
                
        //Obtendo registros de número total sem qualquer pesquisa
        $sqlA = "SELECT $meioQuery FROM $dbtable WHERE situacao = 'ativo' ORDER BY id DESC";      
        $sqlA = $this->db->query($sqlA);
        if($sqlA->rowCount()>0){
            $resultado_user = $sqlA->fetchAll();
            $qnt_linhas = $sqlA->rowCount();
        }else{
            $resultado_user = array();
            $qnt_linhas = 0;
        }   

        //Obter os dados a serem apresentados
        $campos = array();
        $campos = explode(",",$meioQuery);

        $result_usuarios = "SELECT $meioQuery FROM $dbtable WHERE 1=1";
        if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
            
            $result_usuarios.=" AND ( $campos[0] LIKE '%".$requestData['search']['value']."%' ";
            
            for($j=1; $j <= count($campos); $j++ ){
                $result_usuarios.=" OR $campos[$j] LIKE '%".$requestData['search']['value']."%' ";
            }
                
            $result_usuarios.=" )";
        }

        $temp = $this->db->query($result_usuarios);
        if($temp->rowCount()>0){
            $resultado_usuarios = $temp->fetchAll();
            $totalFiltered = $temp->rowCount();
        }else{
            $resultado_usuarios = array();
            $totalFiltered = 0;
        }   

        //Ordenar o resultado
        $result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $resultado_usuarios=mysqli_query($conn, $result_usuarios);

        if (!$resultado_usuarios) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }

        // Ler e criar o array de dados
        $dados = array();
        while( $row_usuarios =mysqli_fetch_array($resultado_usuarios) ) {  
            $dado = array(); 
            $dado[] = $row_usuarios["$campos[0]"];
            $dado[] = $row_usuarios["$campos[1]"];
            $dado[] = $row_usuarios["$campos[2]"];	
            $dados[] = $dado;
        }

        //print_r($dados); exit;

        //Cria o array de informações a serem retornadas para o Javascript
        $json_data = array(
            "draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
            "data" => $dados   //Array de dados completo dos dados retornados da tabela 
        );

        echo json_encode($json_data);  //enviar dados como formato json


    }   
    
    




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

    public function buscaProdutos() {
        $array = array();
        
        $sql = "SELECT * FROM produtos WHERE situacao = 'ativo' ORDER BY id DESC";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
          $array = $sql->fetchAll(); 
        }
        echo json_encode($array); 
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
       //print_r($array); exit; 
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
