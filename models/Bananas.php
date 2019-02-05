<?php
class Bananas extends model {

    protected $table = "clientes";
    protected $logs;

    public function __construct() {
        parent::__construct(); 
        $this->logs = new Logs($this->table);
    }
    
    public function pegarListaBananas() {
       $array = array();
       
       $sql = "SELECT * FROM ". $this->table ." WHERE situacao = 'ativo' ORDER BY id DESC";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll();
       }
       return $array; 
    }
    
    public function buscaBananaPeloNome($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT nome FROM ". $this->table ." WHERE nome='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }

    public function buscaBananaPeloEmail($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT email FROM ". $this->table ." WHERE email='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
   
    public function buscaBananaPeloCPF($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT cpf_cnpj FROM ". $this->table ." WHERE cpf_cnpj='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
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
        
        $request["situacao"] = "ativo";

        $keys = implode(",", array_keys($request));
        
        $values = "'" . implode("','", array_values($this->formataDadosDb($request))) . "'";

        $sql = "INSERT INTO " . $this->table . " (" . $keys . ") VALUES (" . $values . ")";


        $this->db->query($sql);

        if ($this->db->lastInsertId()) {

            $this->logs->add("cadastro", $this->db->lastInsertId(), $request);

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

        if(!empty($id)){

            $this->logs->add("alteracao", $id, $request);

             // Cria a estrutura key = 'valor' para preparar a query do sql
             $output = implode(', ', array_map(
                function ($value, $key) {
                    return sprintf("%s='%s'", $key, addslashes($value));
                },
                $request, //value
                array_keys($request)  //key
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
    }
    
    public function excluir($id){
        if(!empty($id)) {

            $this->logs->add("exclusao", $id);
               
            $sqlA = "UPDATE " . $this->table . " SET situacao = 'excluido' WHERE id = '$id'";
            $this->db->query($sqlA);

            $_SESSION["returnMessage"] = [
                "mensagem" => "Registro deletado com sucesso!",
                "class" => "alert-success"
            ];
        }
    }

}