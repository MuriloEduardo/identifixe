<?php
class estoqueController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("estoque_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
         
    public function index() {
        
        if(in_array("estoque_ver",$_SESSION["permissoesFuncionario"]) == FALSE ||
           in_array("estoque_edt",$_SESSION["permissoesFuncionario"]) == FALSE || 
           in_array("estoque_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/home"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        
        $u = new Unidades();
        $fr =  new Fornecedores();
        $est = new Estoque();
        

        $dados["listaUnidades"]  = $u->pegarListaUnidades($_SESSION["idEmpresaFuncionario"]); 
        $dados["listaFornecedores"]  = $fr->pegarListaFornecedores($_SESSION["idEmpresaFuncionario"]);
        $dados["listaColunas"] = $est->nomeDasColunas();
        $dados["listaEstoque"]  = $est->pegarListaEstoque($_SESSION["idEmpresaFuncionario"]);
        $this->loadTemplate("estoque",$dados);
          
    }
    
}   
  
?>

