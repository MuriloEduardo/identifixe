<?php

class Clientes extends model {

    protected $table = "clientes";

    public function __construct($id = "") {
        parent::__construct(); 
    }
    
    public function pegarListaClientes($empresa) {
       $array = array();
       
       $sql = "SELECT * FROM clientes WHERE id_empresa = '$empresa' AND situacao = 'ativo' ORDER BY id DESC";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    
    public function buscaClientePeloNome($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT nome FROM clientes WHERE nome='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }

    public function buscaClientePeloEmail($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT email FROM clientes WHERE email='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
   
    public function buscaClientePeloCPF($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT cpf_cnpj FROM clientes WHERE cpf_cnpj='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }

    public function adicionar($request) {

        $permissoes = new Permissoes();
        $alteracoes = ucwords($_SESSION["nomeFuncionario"]) . " - " . $permissoes->pegaIPcliente() . " - " . date('d/m/Y H:i:s') . " - CADASTRO";
        
        $request["situacao"] = "ativo";
        $request["alteracoes"] = $alteracoes;

        $keys = implode(",", array_keys($request));
        $values = "'" . implode("','", array_values($request)) . "'";

        $sql = "INSERT INTO " . $this->table . " (" . $keys . ") VALUES (" . $values . ")";
        $this->db->query($sql);

        if ($this->db->lastInsertId()) {
            $_SESSION["returnMessage"] = [
                "mensagem" => "Registro inserido com sucesso!",
                "class" => "alert-success"
            ];
        } else {
            $_SESSION["returnMessage"] = [
                "mensagem" => "Houve uma falha, entre em contato conosco!",
                "class" => "alert-danger"
            ];
        }
    }

    public function adicionarOld($txts,$empresa){
        
        if(count($txts) > 0 && !empty($empresa)){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";
                   
            //tratamento das informações vindas do formulário
            $txt1 =  trim(addslashes($txts[1])); // nome
            $txt2 =       addslashes($txts[2]); // cpf / cnpj
            $txt3 =       addslashes($txts[3]); // celular
            $txt4 =  trim(addslashes($txts[4])); // operadora
            $txt5 =       addslashes($txts[5]); // telefone
            $txt6 =  trim(addslashes($txts[6])); // email
            $txt7 =       addslashes($txts[7]); // cep
            $txt8 =  trim(addslashes($txts[8])); // endereço
            $txt9 =       addslashes($txts[9]); // numero
            $txt10 = trim(addslashes($txts[10])); // complemento
            $txt11 = trim(addslashes($txts[11])); // bairro
            $txt12 = trim(addslashes($txts[12]));// cidade
            $txt13 = trim(addslashes($txts[13])); // observacao
            $txt14 = trim(addslashes($txts[14])); // contatos
                        
            //montagem da query
            $sql = "INSERT INTO clientes(id, id_empresa, nome, cpf_cnpj, celular, operadora, telefone, email, cep, endereco, numero, complemento, bairro, cidade, observacao, contatos, alteracoes, situacao) VALUES ".
             
            "(DEFAULT, ".
            "'$empresa', ".
            "'$txt1', ".
            "'$txt2', ".
            "'$txt3', ".
            "'$txt4', ".
            "'$txt5', ".
            "'$txt6', ".
            "'$txt7', ".
            "'$txt8', ".
            "'$txt9', ".
            "'$txt10', ".
            "'$txt11', ".
            "'$txt12', ".
            "'$txt13', ".
            "'$txt14', ".
            "'$alteracoes', ".
            "'ativo')";
            
            $this->db->query($sql);

        }
    }    
    
    public function pegarInfoCliente($id) {
        $array = array();
        $arrayAux = array();

        $sql = "SELECT * FROM " . $this->table . " WHERE id='$id' AND situacao = 'ativo'";      
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetch();
        }
        foreach ($arrayAux as $chave => $valor){
            $array[$chave] = array(utf8_encode($valor));        
        }
        return $array; 
    }
    
     public function editarOld($id, $txts){
        if(!empty($id) && count($txts) >0 ){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            //$altera = addslashes($txts[21])." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
            
            //tratamento das informações vindas do formulário
            //tratamento das informações vindas do formulário
            $txt1 =  trim(addslashes($txts[1])); // nome
            $txt2 =       addslashes($txts[2]); // cpf / cnpj
            $txt3 =       addslashes($txts[3]); // celular
            $txt4 =  trim(addslashes($txts[4])); // operadora
            $txt5 =       addslashes($txts[5]); // telefone
            $txt6 =  trim(addslashes($txts[6])); // email
            $txt7 =       addslashes($txts[7]); // cep
            $txt8 =  trim(addslashes($txts[8])); // endereço
            $txt9 =       addslashes($txts[9]); // numero
            $txt10 = trim(addslashes($txts[10])); // complemento
            $txt11 = trim(addslashes($txts[11])); // bairro
            $txt12 = trim(addslashes($txts[12]));// cidade
            $txt13 = trim(addslashes($txts[13])); // observacao
            $txt14 = trim(addslashes($txts[14])); // contatos
            
            $altaux = $txts[16];
            $altaux = str_replace("(*", "", $altaux);
            $altaux = str_replace("*)", "", $altaux);
            
            $altera = "$txts[15] | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO >> $altaux";
            
            
            //montagem da query
            $sql = "UPDATE clientes SET ".
                "nome =        '$txt1', ".
                "cpf_cnpj =    '$txt2', ".
                "celular=      '$txt3', ".
                "operadora =   '$txt4', ".
                "telefone =    '$txt5', ".
                "email =       '$txt6', ".
                "cep =         '$txt7', ".
                "endereco =    '$txt8', ".
                "numero =      '$txt9', ".
                "complemento = '$txt10', ".
                "bairro =      '$txt11', ".
                "cidade =      '$txt12', ".
                "observacao =  '$txt13', ".
                "contatos =    '$txt14', ".
                "alteracoes = '$altera' WHERE id = '$id'";
            
            $this->db->query($sql);

        }
    }

    public function editar($id, $request) {

        $output = implode(', ', array_map(
            function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
            $request,
            array_keys($request)
        ));

        $sql = "UPDATE " . $this->table . " SET " . $output . " WHERE id='" . $id . "'";

        $result = $this->db->query($sql);

        if ($result) {
            $_SESSION["returnMessage"] = [
                "mensagem" => "Registro alterado com sucesso!",
                "class" => "alert-success"
            ];
        } else {
            $_SESSION["returnMessage"] = [
                "mensagem" => "Houve uma falha, entre em contato conosco!",
                "class" => "alert-danger"
            ];
        }
    }
    
    public function excluir($id,$empresa){
        if(!empty($id) && !empty($empresa)){
            
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM clientes WHERE id = '$id' AND id_empresa = '$empresa' AND situacao = 'ativo'";
            
            $sql = $this->db->query($sql);
            
            if($sql->rowCount() > 0){  
               $sql = $sql->fetch();
               $palter = $sql["alteracoes"];
               $p = new Permissoes();
               $ipcliente = $p->pegaIPcliente();

               $palter = $palter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
               
               $sqlA = "UPDATE clientes SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id' AND id_empresa = '$empresa'";
               $this->db->query($sqlA);
               
            }
        }
    }
    
}
