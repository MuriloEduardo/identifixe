<?php
class servicosController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("servicos_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        
        $sv = new Servicos();
        
        $dados["listaColunas"] = $sv->nomeDasColunas();
        $dados["listaServicos"]  = $sv->pegarListaServicos($_SESSION["idEmpresaFuncionario"]);
        $this->loadTemplate("servicos",$dados);      
    } 
    
    public function adicionar() {
        
        if(in_array("servicos_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/servicos"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $sv = new Servicos();
        
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $sv->adicionar($txts,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/servicos");
        }else{
            
            $dados["listaColunas"] = $sv->nomeDasColunas();
            $this->loadTemplate("servicos-add",$dados);
        }  
    }
    
    public function editar($id) {
        if(in_array("servicos_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/servicos"); 
        }
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $sv = new Servicos();
        
        $id = addslashes($id);
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $sv->editar($id, $txts,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/servicos");
        }else{
            
            $dados["idSelecionado"] = $id;
            $dados["infoServico"] = $sv->pegarInfoServico($id,$_SESSION["idEmpresaFuncionario"]);
            $dados["listaColunas"] = $sv->nomeDasColunas();
            $this->loadTemplate("servicos-edt",$dados);
        }  
    }

    public function excluir($id) {       
        if(in_array("servicos_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/servicos"); 
        }
        
        $sv = new Servicos();
        $id = addslashes($id);
        
        $sv->excluir($id,$_SESSION["idEmpresaFuncionario"]);
        header("Location: ".BASE_URL."/servicos");  
      }
    
}   
?>

