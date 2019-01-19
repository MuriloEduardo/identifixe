<?php
class fornecedoresController extends controller{
    
    protected $modulo = "fornecedores";
    protected $colunas;
    protected $shared;

    public function __construct() {
        parent::__construct();
        
       $func = new Funcionarios();
       $this->shared = new Shared($this->modulo);

       $this->colunas = $this->shared->nomeDasColunas();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array($this->modulo."_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/dashboard"); 
       }
    }
     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        $dados["listaColunas"] = $this->colunas;
        $this->loadTemplate($this->modulo,$dados);      
    }
    
    public function adicionar() {
        
        if(in_array("fornecedores_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/fornecedores"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $fr = new Fornecedores();
        
        
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $fr->adicionar($txts);
            header("Location: ".BASE_URL."/fornecedores");
        }else{

            $dados["listaColunas"] = $this->colunas;
            $this->loadTemplate("fornecedores-add",$dados);
        }  
    }
    
    public function editar($id) {
        if(in_array("fornecedores_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/fornecedores"); 
        }
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $fr = new Fornecedores();
        
        $id = addslashes($id);
        if(isset($_POST["txt"]) && count($_POST["txt"])> 0){
            $txts = $_POST["txt"]; 
            $fr->editar($id, $txts);
            header("Location: ".BASE_URL."/fornecedores");
        }else{
            
            $dados["infoForn"] = $fr->pegarInfoForn($id);
            $dados["listaColunas"] = $this->colunas;
            $this->loadTemplate("fornecedores-edt",$dados);
        }  
    }

    public function excluir($id) {
        if(in_array("fornecedores_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/fornecedores"); 
        }
        
        $fr = new Fornecedores();
        $id = addslashes($id);

        $fr->excluir($id);
        header("Location: ".BASE_URL."/fornecedores");  
      }
    }   
  
?>

