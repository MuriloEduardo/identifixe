<?php
class funcionariosController extends controller{

    protected $modulo = "funcionarios";
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
            $dados["listaGruposPerm"] = $p->pegarListaGrupos();
            $dados["listaColunas"] = $this->colunas;
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
            $fn->editar($id, $txts);
            header("Location: ".BASE_URL."/funcionarios");
        }else{
            
            $p = new Permissoes();
            $dados["idSelecionado"] = $id;
            $dados["listaGruposPerm"] = $p->pegarListaGrupos();
            $dados["infoFuncionario"] = $fn->pegarInfoFunc($id);
            $dados["listaColunas"] = $this->colunas;
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