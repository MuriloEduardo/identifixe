<?php
class clientesController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("clientes_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        
        $cl = new Clientes();
        
        $dados["listaColunas"] = $cl->nomeDasColunas();
        $dados["listaClientes"]  = $cl->pegarListaClientes($_SESSION["idEmpresaFuncionario"]);
        $this->loadTemplate("clientes",$dados);      
    } 
    
    public function adicionar() {
        
        if(in_array("clientes_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/clientes"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $cl = new Clientes();
        
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $cl->adicionar($txts,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/clientes");
        }else{
            
            $dados["listaColunas"] = $cl->nomeDasColunas();
            $this->loadTemplate("clientes-add",$dados);
        }  
    }
    
    public function editar($id) {
        if(in_array("clientes_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/clientes"); 
        }
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $cl = new Clientes();
        
        $id = addslashes($id);
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $cl->editar($id, $txts,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/clientes");
        }else{
            
            $dados["idSelecionado"] = $id;
            $dados["infoCliente"] = $cl->pegarInfoCliente($id,$_SESSION["idEmpresaFuncionario"]);
            $dados["listaColunas"] = $cl->nomeDasColunas();
            $this->loadTemplate("clientes-edt",$dados);
        }  
    }

    public function excluir($id) {       
        if(in_array("clientes_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/clientes"); 
        }
        
        $cl = new Clientes();
        $id = addslashes($id);
        
        $cl->excluir($id,$_SESSION["idEmpresaFuncionario"]);
        header("Location: ".BASE_URL."/clientes");  
      }
    
}   
?>

