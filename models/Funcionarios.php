<?php

class Funcionarios extends model {
    
    protected $table = "clientes";
    protected $permissoes;

    public function __construct() {
        parent::__construct(); 
        $this->permissoes = new Permissoes();
    }
     
    public function isLogged(){
        if(isset($_SESSION["idFuncionario"]) && !empty($_SESSION["idFuncionario"]) && isset($_SESSION["permissoesFuncionario"]) && !empty($_SESSION["permissoesFuncionario"])){
            return true; 
        }else{
            return false;
        }
    }
    
    public function fazerLogin($email,$senha){
        $array = array();
        if(!empty($senha) && !empty($email)){
           $senha = addslashes($senha);
           $email = addslashes($email);
           
           $sql = "SELECT * FROM funcionarios WHERE email='$email' AND senha = '$senha' AND situacao = 'ativo'";

           $sql = $this->db->query($sql);
           if($sql->rowCount()>0){
              $sql = $sql->fetch();
              
              //buscar as informaçoes do usuario logado
              $_SESSION["nomeFuncionario"] = $sql["nome"];
              $_SESSION["idFuncionario"] = $sql["id"];
              $_SESSION["emailFuncionario"] = $sql["email"];
            
              
              //buscar as permissoes que o usuario tem
              $p = new Permissoes();
              $_SESSION["permissoesFuncionario"] = $p->getPermissoes($sql["id_gp"]);
              
              //verifica se todas as informações de login estão corretas
              if(empty($_SESSION["nomeFuncionario"]) || empty($_SESSION["idFuncionario"]) || empty($_SESSION["emailFuncionario"])){
                 return false;     
              }
              if(empty($_SESSION["permissoesFuncionario"])){
                 return false; 
              }
              return true;
           }else{
              return false;     
           }
        }
    }
    
    public function qtdFuncionariosGrupo($id_grupo,$empresa){ // função usada no model de permissões
        if(!empty($id_grupo) && !empty($empresa)){
           $numFunc = 0;
           $sql = "SELECT COUNT(*) as c FROM funcionarios WHERE id_empresa = '$empresa' AND id_grupopermissao = '$id_grupo'";
           $sql = $this->db->query($sql);
           $sql = $sql->fetch();
           $numFunc =  $sql["c"];
 
           return $numFunc;
        }
    }
    
    public function buscaFuncPeloNome($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT nome FROM funcionarios WHERE nome='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
    public function buscaFuncPeloEmail($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT email FROM funcionarios WHERE email='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
    public function buscaFuncPeloCPF($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT cpf FROM funcionarios WHERE cpf='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
    public function novaSenhaSalva($idselec,$senhavelha,$senhanova,$empresa){
        if(!empty($idselec) && !empty($senhavelha) && !empty($senhanova) && !empty($empresa)){
            $resp = array();
            $info = array();
            $sql = "SELECT senha, alteracoes FROM funcionarios WHERE id='$idselec' AND id_empresa='$empresa' AND situacao='ativo'";
            
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){ //encontrou o id selecionado
               $info = $sql->fetch(); 
            
               $senhavelha = md5($senhavelha);
               $senhanova = md5($senhanova);
               
               if($senhavelha == $info['senha']){
                    $p = new Permissoes();
                    $ipcliente = $p->pegaIPcliente();
                    $altera = $info['alteracoes']." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO SENHA";
                    
                    $sqlA = "UPDATE funcionarios SET senha = '$senhanova', alteracoes = '$altera' WHERE id='$idselec' AND id_empresa='$empresa'";
                   
                    $sqlA = $this->db->query($sqlA);
                    
                    $resp['resultado'] = 'sim';
               }else{//a senha antiga não corresponde
                   $resp['resultado'] = 'senha';
               }
            }else{
                $resp['resultado'] = 'selecionado';
            }
            
            return $resp;
        }    
    }

    public function pegarInfo($id) {
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

    public function adicionar($request) {

        $alteracoes = ucwords($_SESSION["nomeFuncionario"]) . " - " . $this->permissoes->pegaIPcliente() . " - " . date('d/m/Y H:i:s') . " - CADASTRO";
        
        $request["situacao"] = "ativo";
        $request["alteracoes"] = $alteracoes;

        $keys = implode(",", array_keys($request));
        $values = "'" . implode("','", array_values($this->formataDadosDb($request))) . "'";

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
    
    public function excluir($id){
        if(!empty($id)){
            
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM " . $this->table . " WHERE id = '$id' AND situacao = 'ativo'";
            
            $sql = $this->db->query($sql);
            
            if($sql->rowCount() > 0){  
               $sql = $sql->fetch();
               $palter = $sql["alteracoes"];
               $ipcliente = $this->permissoes->pegaIPcliente();

               $palter = $palter . " | " . ucwords($_SESSION["nomeFuncionario"]) . " - $ipcliente - " . date('d/m/Y H:i:s') . " - EXCLUSAO";
               
               $sqlA = "UPDATE " . $this->table . " SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id'";
               $this->db->query($sqlA);

                $_SESSION["returnMessage"] = [
                    "mensagem" => "Registro deletado com sucesso!",
                    "class" => "alert-success"
                ];
            }
        }
    }
    
}
