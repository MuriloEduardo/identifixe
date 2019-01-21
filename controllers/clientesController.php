<?php
class clientesController extends controller{

    protected $modulo = "clientes";
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
        $dados["colunas"] = $this->colunas;
        $this->loadTemplate($this->modulo,$dados);      
    }
    
    public function adicionar() {
        
        if(in_array($this->modulo. "_add", $_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }
        
        $dados['infoFunc'] = $_SESSION;
        $clientes = new Clientes();
        
        if(isset($_POST) && !empty($_POST)){
            $clientes->adicionar($_POST);
            header("Location: " . BASE_URL . "/" . $this->modulo);
        }else{
            $dados["colunas"] = $this->colunas;
            $this->loadTemplate($this->modulo . "-add",$dados);
        }
    }
    
    public function editar($id) {

        if(in_array($this->modulo . "_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }

        $dados['infoFunc'] = $_SESSION;
        $clientes = new Clientes();
        
        if(isset($_POST) && !empty($_POST)){
            $clientes->editar($id, $_POST);
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }else{
            $dados["dados"] = $clientes->pegarInfoCliente($id);
            $dados["colunas"] = $this->colunas;
            $this->loadTemplate($this->modulo . "-edt", $dados);
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