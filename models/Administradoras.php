
<?php

class Administradoras extends model {
    
    public function __construct($id = "") {
        parent::__construct(); 
    }
        
    public function pegarListaAdministradoras($empresa) {
       $array = array();
       
       $sql = "SELECT id, nome FROM administradoras WHERE id_empresa = '$empresa' AND situacao = 'ativo' ORDER BY id DESC";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    public function pegarListaBandeiras($empresa) {
       $array = array();
       
       $sql = "SELECT id, nome FROM bandeiras WHERE id_empresa = '$empresa' AND situacao = 'ativo'";      
       $sql = $this->db->query($sql);
       if($sql->rowCount()>0){
         $array = $sql->fetchAll(); 
       }
       return $array; 
    }
    

    public function adicionar($nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos,$empresa){
        
        if(!empty($nome) && !empty($bandeiras) && !empty($informacoes) && !empty($txantecipacoes) && !empty($txcreditos) && !empty($empresa)){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - CADASTRO";
            //inserir a administradora e depois inserir as bandeiras aceitas////////////////////////////////////////////////////
            $sql = "INSERT INTO administradoras (id, id_empresa, nome, alteracoes, situacao) VALUES (DEFAULT, '$empresa', '$nome', '$alteracoes', 'ativo')";
            $this->db->query($sql);
            
            //inserir as bandeiras //////////////////////////////////////////////////////////////////////////////////////////////
            $id_adm = $this->db->lastInsertId();
            
            $sqlA = "INSERT INTO bandeiras_aceitas (id, id_empresa, nome, informacoes, txantecipacao, txcredito, id_adm, alteracoes, situacao) VALUES ";
            $sqlAux = "";
                    foreach ($bandeiras as $idBand => $nomeBand){
                        $sqlAux = $sqlAux."(DEFAULT, '$empresa', '$idBand', '$informacoes[$idBand]','$txantecipacoes[$idBand]', '$txcreditos[$idBand]', '$id_adm', '$alteracoes', 'ativo'), ";
                    }
                    $sqlAux = substr_replace($sqlAux,"", strrpos($sqlAux, ","));
                    $sqlA = $sqlA.$sqlAux.";";
                    $this->db->query($sqlA);
        }           
    }

    public function pegarBandeirasAceitas($id_adm,$empresa){
       $array = array();
       if(!empty($id_adm) && !empty($empresa)){         
            $sql = "SELECT * FROM bandeiras_aceitas WHERE id_empresa = '$empresa' AND id_adm = '$id_adm' AND situacao = 'ativo'";
            $sql = $this->db->query($sql);
                
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }
        }
        return $array;
    }  
    
    public function pegarListaBandeirasAceitas($idadm,$empresa){
        $array = array();
        if(!empty($idadm) && !empty($empresa)){
            //$sqlA = "SELECT * FROM bandeiras_aceitas WHERE id_adm ='$idadm' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sqlA = "SELECT ba.id, ba.informacoes, ba.txantecipacao, ba.txcredito, b.nome ".
                    "FROM bandeiras_aceitas as ba INNER JOIN bandeiras as b ON ba.nome = b.id ".
                    "WHERE ba.id_adm ='$idadm' AND ba.id_empresa = '$empresa'";
            $sqlA = $this->db->query($sqlA);
            if($sqlA->rowCount()>0){
                $sqlA = $sqlA->fetchAll();
                foreach ($sqlA as $chave => $valor){
                    $array[$chave] = array("id" => $valor["id"], "nome" => utf8_encode(ucwords($valor["nome"])), "informacoes" => $valor["informacoes"],
                                            "txantecipacao" => $valor["txantecipacao"], "txcredito" => $valor["txcredito"]);
                }   
            }
        }
        return $array;
    }
    
    public function pegarInfoAdm($id_adm,$empresa){
        $array = array();
       if(!empty($id_adm) && !empty($empresa)){         
            $sql = "SELECT * FROM administradoras WHERE id_empresa = '$empresa' AND id = '$id_adm' AND situacao = 'ativo'";
            $sql = $this->db->query($sql);
                
            if($sql->rowCount() > 0){
                $array = $sql->fetch();
            }
        }
        return $array;
    }
    
    public function editar($id_adm, $nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos, $alter, $empresa){
        if(!empty($id_adm) && !empty($nome) && !empty($bandeiras) && !empty($informacoes) && !empty($txantecipacoes) && !empty($txcreditos) && !empty($alter) && !empty($empresa)){
            
            $p = new Permissoes();
            $ipcliente = $p->pegaIPcliente();
            $altera = $alter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
            
            /////// atualiza o nome e as alterações da administradora
            $sql = "UPDATE administradoras SET nome='$nome', alteracoes='$altera' WHERE id='$id_adm' AND id_empresa='$empresa'";          
            $this->db->query($sql);
            
            //busca as informações das bandeiras cadastradas
            $idCad = array();
            $alterCad = array();
            $sql = "SELECT id, alteracoes FROM bandeiras_aceitas WHERE id_empresa = '$empresa' AND id_adm = '$id_adm' AND situacao = 'ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount() > 0){
               foreach ($sql->fetchAll() as $idChave => $idValor){
                    $idCad[] = $idValor["id"];
                    $alterCad[] = array($idValor["id"] => $idValor["alteracoes"]);
                } 
            }

            //// atualiza as bandeiras da administradora >>>> se já existe atualiza >>> se não existe insere
            foreach ($bandeiras as $idBand => $nomeBand){
                if(in_array($idBand, $idCad)){
                    
                    //foi encontrada deve ser atualizada
                    $aux = array_column($alterCad, intval($idBand));
                    $altera1 =  $aux[0];
                    $altera1 = $altera1." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - ALTERACAO";
                    $sqlA = "UPDATE bandeiras_aceitas SET  informacoes='$informacoes[$idBand]', txantecipacao='$txantecipacoes[$idBand]', txcredito='$txcreditos[$idBand]',".
                            " alteracoes='$altera1' WHERE id='$idBand' AND id_empresa='$empresa' AND id_adm='$id_adm'";
                    $sqlA = $this->db->query($sqlA);
                }else{
                    
                    //não foi encontrada deve ser inserida
                    $alteracoes = ucwords($_SESSION["nomeFuncionario"])." - (ipcliente) - ".date('d/m/Y H:i:s')." - CADASTRO";
                    $sqlB ="INSERT INTO bandeiras_aceitas (id, id_empresa, nome, informacoes, txantecipacao, txcredito, id_adm, alteracoes, situacao) VALUES".
                    " (DEFAULT, '$empresa', '$nomeBand', '$informacoes[$idBand]','$txantecipacoes[$idBand]', '$txcreditos[$idBand]', '$id_adm', '$alteracoes', 'ativo')";                   
                    $sqlB = $this->db->query($sqlB);
                }
            }
            
            ///exclui as bandeiras que forasm cadastradas anteriormente, mas foram excluidas do cadastro
            foreach ($idCad as $idVal){
                 if(array_key_exists($idVal, $bandeiras)){ 
                     //foi encontrada e já foi atualizada
                 }else{
                     //não foi encontrada deve ser excluida
                     $aux1 = array_column($alterCad, intval($idVal));
                     $alterac =  $aux1[0];
                     $alterac = $alterac." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
                     $sqlC = "UPDATE bandeiras_aceitas SET alteracoes='$alterac', situacao='excluido' WHERE id='$idVal' AND id_empresa='$empresa' AND id_adm='$id_adm'";
                     $sqlC = $this->db->query($sqlC);
                 }
             } 
            
        }
    }

    public function excluir($id_adm,$empresa){
        if(!empty($id_adm) && !empty($empresa)){
            
            //se não achar nenhum usuario associado ao grupo - pode deletar, ou seja, tornar o cadastro situacao=excluído
            $sql = "SELECT alteracoes FROM administradoras WHERE id = '$id_adm' AND id_empresa = '$empresa' AND situacao = 'ativo'";
            $sql = $this->db->query($sql);

            if($sql->rowCount() > 0){ 
               $sql = $sql->fetch(); 
               $palter = $sql["alteracoes"];
               $p = new Permissoes();
               $ipcliente = $p->pegaIPcliente();
               //exclui a administradora
               $palter = $palter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
               $sqlA = "UPDATE administradoras SET alteracoes = '$palter', situacao = 'excluido' WHERE id = '$id_adm' AND id_empresa = '$empresa'";
               $this->db->query($sqlA);
               
               
               $sqlB = "SELECT * FROM bandeiras_aceitas WHERE id_empresa = '$empresa' AND id_adm = '$id_adm' AND situacao = 'ativo'";
               $sqlB = $this->db->query($sqlB);
                if($sqlB->rowCount() > 0){
                    $sqlB = $sqlB->fetchAll();
                                     
                    foreach ($sqlB as $valorBand) {
                        //exclui as bandeiras da administradora
                         
                        $alter = $valorBand["alteracoes"];
                        $alter = $alter." | ".ucwords($_SESSION["nomeFuncionario"])." - $ipcliente - ".date('d/m/Y H:i:s')." - EXCLUSAO";
                        $sqlC = "UPDATE bandeiras_aceitas SET alteracoes = '$alter', situacao = 'excluido' WHERE id_adm = '$id_adm' AND id_empresa = '$empresa' AND id=".$valorBand['id'];
                        $this->db->query($sqlC);  
                    }
               }
            }         
        }
    }
    
    public function buscaAdmPeloNome($nome,$empresa){
        $array = array();
        if(!empty($nome) && !empty($empresa)){
            $sql = "SELECT nome FROM administradoras WHERE nome='$nome' AND id_empresa = '$empresa' AND situacao='ativo'";
            $sql = $this->db->query($sql);
            if($sql->rowCount()>0){
                $array = $sql->fetchAll();
            } 
        }
        return $array;
    }
    
}
