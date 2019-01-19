<?php

class Funcionarios extends model {
    

    public function __construct($id = "") {
        parent::__construct(); 
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
    
    public function adicionar($txts,$empresa){
        
        if(count($txts) > 0 && !empty($empresa)){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";
                   
            //tratamento das informações vindas do formulário
            $txt1 =  addslashes($txts[1]); // nome
            $txt2 =  addslashes($txts[2]); // email
            $txt3 =  addslashes($txts[3]); // cpf
            $txt4 =  addslashes($txts[4]); // cep
            $txt5 =  addslashes($txts[5]); // endereco
            $txt6 =  addslashes($txts[6]); // numero
            $txt7 =  addslashes($txts[7]); // complemento
            $txt8 =  addslashes($txts[8]); // bairro
            $txt9 =  addslashes($txts[9]); // cidade
            $txt10 = addslashes($txts[10]); // telefone
            $txt11 = addslashes($txts[11]); // celular
            $txt12 = addslashes($txts[12]);// inicio_relacao
            $txt13 = addslashes($txts[13]); // grupo_permissao
            $txt14 = addslashes($txts[14]); // id_gp
            $txt15 = addslashes($txts[15]); // observacao
            $txt16 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[16]))));// salario            
            $txt17 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[17]))));// comissao            
            $txt18 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[18]))));// fgts            
            $txt19 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[19]))));// inss            
            $txt20 = md5(addslashes($txts[20])); // senha
            
            //montagem da query
            $sql = "INSERT INTO funcionarios(id, id_empresa, nome, email, cpf, cep, endereco, numero, complemento, bairro, cidade, telefone, celular, inicio_relacao,grupo_permissao, id_gp, observacao, salario, comissao, fgts, inss, senha, alteracoes, situacao) VALUES ".
            
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
            "'$txt15', ".
            "'$txt16', ".
            "'$txt17', ".
            "'$txt18', ".
            "'$txt19', ".
            "'$txt20', ".
            "'$alteracoes', ".
            "'ativo')";
            
            $this->db->query($sql);

        }
    }    
    
     public function pegarInfoFunc($id) {
       $array = array();
       
       $sql = "SELECT * FROM funcionarios WHERE id='$id' AND situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    
     public function editar($id, $txts){
        if(!empty($id) && count($txts) >0 ){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $altera = addslashes($txts[21])." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
            
            //tratamento das informações vindas do formulário
            $txt1 =  addslashes($txts[1]); // nome
            $txt2 =  addslashes($txts[2]); // email
            $txt3 =  addslashes($txts[3]); // cpf
            $txt4 =  addslashes($txts[4]); // cep
            $txt5 =  addslashes($txts[5]); // endereco
            $txt6 =  addslashes($txts[6]); // numero
            $txt7 =  addslashes($txts[7]); // complemento
            $txt8 =  addslashes($txts[8]); // bairro
            $txt9 =  addslashes($txts[9]); // cidade
            $txt10 = addslashes($txts[10]); // telefone
            $txt11 = addslashes($txts[11]); // celular
            $txt12 = addslashes($txts[12]);// inicio_relacao
            $txt13 = addslashes($txts[13]); // grupo_permissao
            $txt14 = addslashes($txts[14]); // id_gp
            $txt15 = addslashes($txts[15]); // observacao
            $txt16 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[16]))));// salario            
            $txt17 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[17]))));// comissao            
            $txt18 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[18]))));// fgts            
            $txt19 = floatval(str_replace(",",".",str_replace(".","",addslashes($txts[19]))));// inss            
            
            
            //montagem da query
            $sql = "UPDATE funcionarios SET ".
                "nome =            '$txt1', ".
                "email =           '$txt2', ".
                "cpf=              '$txt3', ".
                "cep =             '$txt4', ".
                "endereco =        '$txt5', ".
                "numero =          '$txt6', ".
                "complemento =     '$txt7', ".
                "bairro =          '$txt8', ".
                "cidade =          '$txt9', ".
                "telefone =        '$txt10', ".
                "celular =         '$txt11', ".
                "inicio_relacao =  '$txt12', ".
                "grupo_permissao = '$txt13', ".
                "id_gp =           '$txt14', ".
                "observacao =      '$txt15', ".
                "salario =         '$txt16', ".
                "comissao =        '$txt17', ".
                "fgts =            '$txt18', ".
                "inss =            '$txt19', ".
                "alteracoes = '$altera' WHERE id='$id'";
            
            $this->db->query($sql);

        }
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

    public function excluir($id,$empresa){
        if(!empty($id) && !empty($empresa)){
            
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM funcionarios WHERE id = '$id' AND id_empresa = '$empresa' AND situacao = 'ativo'";
            
            $sql = $this->db->query($sql);
            
            if($sql->rowCount() > 0){  
               $sql = $sql->fetch();
               $palter = $sql["alteracoes"];
               $p = new Permissoes();
               $ipcliente = $p->pegaIPcliente();

               $palter = $palter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
               
               $sqlA = "UPDATE funcionarios SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id' AND id_empresa = '$empresa'";
               $this->db->query($sqlA);
               
            }
        }
    }
    
}
