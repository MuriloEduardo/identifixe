<?php
class clientesController extends controller{

    protected $modulo = "clientes";
    protected $colunas;
    
    protected $shared;
    protected $clientes;
    protected $funcionarios;

    public function __construct() {

        parent::__construct();

        $this->shared = new Shared($this->modulo);
        $this->clientes = new Clientes();
        $this->funcionarios = new Funcionarios();
        
        if($this->funcionarios->isLogged() == false){
            header("Location: " . BASE_URL . "/login"); 
        }

        $this->colunas = $this->shared->nomeDasColunas();

        // verifica se tem permissão para ver esse módulo
        if(in_array($this->modulo."_ver", $_SESSION["permissoesFuncionario"]) == false){
            header("Location: " . BASE_URL . "/dashboard"); 
        }
    }
     
    public function index() {
        $dados['infoFunc'] = $_SESSION;
        $dados["colunas"] = $this->colunas;
        $this->loadTemplate($this->modulo, $dados);      
    }
    
    public function adicionar() {
        
        if(in_array($this->modulo. "_add", $_SESSION["permissoesFuncionario"]) == false){
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }
        
        $dados['infoFunc'] = $_SESSION;
        
        if(isset($_POST) && !empty($_POST)){
            $this->clientes->adicionar($_POST);
            header("Location: " . BASE_URL . "/" . $this->modulo);
        }else{
            $dados["colunas"] = $this->colunas;
            $dados["viewInfo"] = ["title" => "Adicionar"];
            $this->loadTemplate($this->modulo . "-form",$dados);
        }
    }
    
    public function editar($id) {

        if(in_array($this->modulo . "_edt", $_SESSION["permissoesFuncionario"]) == false || empty($id) || !isset($id)){
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }

        $dados['infoFunc'] = $_SESSION;
        
        if(isset($_POST) && !empty($_POST)){
            $this->clientes->editar($id, $_POST);
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }else{
            $dados["dados"] = $clientes->pegarInfoCliente($id);
            $dados["colunas"] = $this->colunas;
            $dados["viewInfo"] = ["title" => "Editar"];
            $this->loadTemplate($this->modulo . "-form", $dados);
        }
    }

    public function excluir($id){

        if(in_array($this->modulo . "_exc", $_SESSION["permissoesFuncionario"]) == false || empty($id) || !isset($id)){
            header("Location: " . BASE_URL . "/" . $this->modulo); 
        }

        $this->clientes->excluir($id);

        header("Location: " . BASE_URL . "/clientes");  
    }
    
}   
?>