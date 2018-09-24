<?php
class funcionariosController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("funcionarios_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        
        $fn = new Funcionarios();
        
        $dados["listaColunas"] = $fn->nomeDasColunas();
        $dados["listaFuncionarios"]  = $fn->pegarListaFuncionarios($_SESSION["idEmpresaFuncionario"]);
        $this->loadTemplate("funcionarios",$dados);      
    } 
    
    public function adicionar() {
        
        if(in_array("funcionarios_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/funcionarios"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $fn = new Funcionarios();
        
        
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $fn->adicionar($txts,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/funcionarios");
        }else{
            
            $p = new Permissoes();
            $dados["listaGruposPerm"] = $p->pegarListaGrupos($_SESSION["idEmpresaFuncionario"]);
            $dados["listaColunas"] = $fn->nomeDasColunas();
            $this->loadTemplate("funcionarios-add",$dados);
        }  
    }
    
    public function editar($id) {
        if(in_array("funcionarios_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/funcionarios"); 
        }
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $fn = new Funcionarios();
        
        $id = addslashes($id);
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $fn->editar($id, $txts,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/funcionarios");
        }else{
            
            $p = new Permissoes();
            $dados["idSelecionado"] = $id;
            $dados["listaGruposPerm"] = $p->pegarListaGrupos($_SESSION["idEmpresaFuncionario"]);
            $dados["infoFuncionario"] = $fn->pegarInfoFunc($id,$_SESSION["idEmpresaFuncionario"]);
            $dados["listaColunas"] = $fn->nomeDasColunas();
            $this->loadTemplate("funcionarios-edt",$dados);
        }  
    }

    public function excluir($id) {       
        if(in_array("funcionarios_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/funcionarios"); 
        }
        
        $fn = new Funcionarios();
        $id = addslashes($id);
        
        $fn->excluir($id,$_SESSION["idEmpresaFuncionario"]);
        header("Location: ".BASE_URL."/funcionarios");  
      }
    }   
  
?>

