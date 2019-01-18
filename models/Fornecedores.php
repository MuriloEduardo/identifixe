
<?php

class Fornecedores extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarListaFornecedores() {
       $array = array();
       
       $sql = "SELECT * FROM fornecedores WHERE situacao = 'ativo' ORDER BY id DESC";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    
     public function pegarInfoForn($id) {
       $array = array();
       
       $sql = "SELECT * FROM fornecedores WHERE id='$id' AND situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }

    public function adicionar($txts){
        
        if(count($txts) > 0){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";
            
            //tratamento das informações vindas do formulário
            $txt1 = addslashes($txts[1]); // nomefantasia
            $txt2 = addslashes($txts[2]); // sigla
            $txt3 = addslashes($txts[3]); // razaosocial
            $txt4 = addslashes($txts[4]); // cnpj
            $txt5 = addslashes($txts[5]); // cep
            $txt6 = addslashes($txts[6]); // endereco
            $txt7 = addslashes($txts[7]); // numero
            $txt8 = addslashes($txts[8]); // complemento
            $txt9 = addslashes($txts[9]); // bairro
            $txt10 = addslashes($txts[10]); // cidade
            $txt11 = addslashes($txts[11]); // telefone
            $txt12 = addslashes($txts[12]); // celular
            $txt13 = addslashes($txts[13]); // contato
            $txt14 = addslashes($txts[14]); // site
            $txt15 = addslashes($txts[15]); // observacao
            
            //montagem da query
            $sql = "INSERT INTO fornecedores (id, nomefantasia, sigla, razaosocial, cnpj, cep, endereco, numero, complemento, bairro,".
                                             "cidade, telefone, celular, contato, site, observacao, alteracoes, situacao) VALUES ".
            "(DEFAULT, ".
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
            "'$txt15', ".
            "'$alteracoes', ".
            "'ativo')";
            
            $this->db->query($sql);

        }
    }    
    
    public function editar($id, $txts){
        if(!empty($id) && count($txts) >0 ){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $altera = addslashes($txts[16])." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
            
            //tratamento das informações vindas do formulário
            $txt1 = addslashes($txts[1]); // nomefantasia
            $txt2 = addslashes($txts[2]); // sigla
            $txt3 = addslashes($txts[3]); // razaosocial
            $txt4 = addslashes($txts[4]); // cnpj
            $txt5 = addslashes($txts[5]); // cep
            $txt6 = addslashes($txts[6]); // endereco
            $txt7 = addslashes($txts[7]); // numero
            $txt8 = addslashes($txts[8]); // complemento
            $txt9 = addslashes($txts[9]); // bairro
            $txt10 = addslashes($txts[10]); // cidade
            $txt11 = addslashes($txts[11]); // telefone
            $txt12 = addslashes($txts[12]); // celular
            $txt13 = addslashes($txts[13]); // contato
            $txt14 = addslashes($txts[14]); // site
            $txt15 = addslashes($txts[15]); // observacao
            
            //montagem da query
            $sql = "UPDATE fornecedores SET ".
                "nomefantasia =  '$txt1', ".
                "sigla =         '$txt2', ".
                "razaosocial=    '$txt3', ".
                "cnpj =          '$txt4', ".
                "cep =           '$txt5', ".
                "endereco =      '$txt6', ".
                "numero =        '$txt7', ".
                "complemento =   '$txt8', ".
                "bairro =        '$txt9', ".
                "cidade =        '$txt10', ".
                "telefone =      '$txt11', ".
                "celular =       '$txt12', ".
                "contato =       '$txt13', ".
                "site =          '$txt14', ".
                "observacao =    '$txt15', ".
                "alteracoes = '$altera' WHERE id='$id'";

            $this->db->query($sql);

        }
    }

    public function excluir($id){
        if(!empty($id)){
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM fornecedores WHERE id = '$id' AND situacao = 'ativo'";
            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0){ 
               $sql = $sql->fetch(); 
               $palter = $sql["alteracoes"];
               $p = new Permissoes();
               $ipcliente = $p->pegaIPcliente();
               
               $palter = $palter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
               $sqlA = "UPDATE fornecedores SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id'";
               $this->db->query($sqlA);
               
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
