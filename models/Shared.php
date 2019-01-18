<?php

class Shared extends model {

    public function __construct($id = "") {
        parent::__construct(); 
    }

    public function montaDataTable($dbtable) {

        $sql = "SHOW COLUMNS FROM $dbtable";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $sql = $sql->fetchAll(); 
            foreach ($sql as $chave => $valor){
                $array[$chave] = array( "nomecol" => utf8_encode(ucwords($valor["Field"])));                                      
            }
        }
     
        $meioQuery = '';
        for($i=0; $i < count($array)-2; $i++){
            //Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
            $meioQuery.= lcfirst($array[$i]['nomecol'])." ,";
        }

        // print_r($meioQuery);exit;
        
        // Retira a ultima virgula que sobre
        $meioQuery = substr($meioQuery, 0, -1);
        
        //Receber a requisão da pesquisa 
        $requestData = $_POST;
                
        //Obtendo registros de número total sem qualquer pesquisa
        $sqlA = "SELECT $meioQuery FROM $dbtable WHERE situacao = 'ativo' ORDER BY id DESC";      
        $sqlA = $this->db->query($sqlA);
        $temporaria = array();
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

        $result_usuarios = "SELECT $meioQuery FROM $dbtable WHERE situacao = 'ativo'";
        //echo $result_usuarios; exit;
        if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
            
            $result_usuarios.=" AND ".$campos[0]." LIKE '%".$requestData['search']['value']."%' ";
            
            for($j=1; $j <= count($campos); $j++ ){
                if (strlen($campos[$j]) > 0) {
                    $result_usuarios.=" OR $campos[$j] LIKE '%".$requestData['search']['value']."%' ";
                }
            }
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
        //print_r($campos); exit;

        $columnOrdering = '';
        $tipoOrdem = 'desc';
        if ($requestData['order'][0]['column'] < 1) {
            // Se a requisicao chegar aqui sem ser clicada em nenhum campo
            // pula a coluna de acoes e ordena pelo primerio da tabela
            $tipoOrdem = 'DESC';
            $columnOrdering = $campos[0];
        }else {
            $tipoOrdem =  $requestData['order'][0]['dir'];
            $columnOrdering = $campos[$requestData['order'][0]['column'] - 1];
        }
        $result_usuarios.=" ORDER BY ". $columnOrdering."   ".$tipoOrdem."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        
        //echo $result_usuarios; exit;
        
        $temp2 = $this->db->query($result_usuarios);
        if($temp2->rowCount()>0){
            $resultado_usuarios = $temp2->fetchAll();
            $totalFiltered = $temp2->rowCount();
        }else{
            $resultado_usuarios = array();
            $totalFiltered = 0;
        } 

        //print_r($resultado_usuarios); exit;
        //print_r($campos); exit;
        // Ler e criar o array de dados
        //print_r($campos);exit;
        $matriz = array();
        for($lin = 0; $lin < count($resultado_usuarios)-1; $lin++){ // quantidade de registrados mostrados 0 - 9 provavelmente 
            $vetor = array(); 
            for($col = 0; $col <= count($campos); $col++){
                if($col == 0){
                    $vetor[$col] = '
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações">
                            <a href="localhost/identifixe/' . $dbtable . '/editar/' . $resultado_usuarios[$lin][$col] . '" class="btn btn-primary">Editar</a>
                            <a href="localhost/identifixe/' . $dbtable . '/excluir/' . $resultado_usuarios[$lin][$col] . '" onclick="return confirm(\'Tem Certeza?\')" class="btn btn-secondary">Excluir</a>
                        </div>
                    ';
                }else{
                    $vetor[$col] = $resultado_usuarios[$lin][$col];
                    //print_r($vetor);exit;
                }
            }
            $matriz[$lin] = $vetor;
            //print_r($matriz);exit;
        }

        //print_r($matriz); exit;
        //Cria o array de informações a serem retornadas para o Javascript
        $json_data = array(
            "draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
            "recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
            "recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
            "data" => $matriz   //Array de dados completo dos dados retornados da tabela 
        );

        return $json_data;  //enviar dados como formato json
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
}
?>