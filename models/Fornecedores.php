
<?php
class Fornecedores extends model {

    protected $table = "fornecedores";
    protected $permissoes;
    
    public function __construct() {
        parent::__construct(); 
        $this->permissoes = new Permissoes();
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
            function ($v, $k) {
                return sprintf("%s='%s'", $k, addslashes($v));
            },
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
    
    public function buscaFornPeloNomeFantasia($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT nomefantasia FROM fornecedores WHERE nomefantasia='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
    public function buscaFornPelaSigla($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT sigla FROM fornecedores WHERE sigla='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
    public function buscaFornPelaRazao($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT razaosocial FROM fornecedores WHERE razaosocial='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
    public function buscaFornPeloCnpj($nome){
        $array = array();
        if(!empty($nome)){
            $sql = "SELECT cnpj FROM fornecedores WHERE cnpj='$nome' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
}