<?php
class funcionariosController extends controller{

    protected $table = "funcionarios";
    protected $colunas;
    
    protected $model;
    protected $funcionarios;

    public function __construct() {

        parent::__construct();

        $this->funcionarios = new Funcionarios();
        $this->model = $this->funcionarios;
        
        if($this->funcionarios->isLogged() == false){
            header("Location: " . BASE_URL . "/login"); 
        }

        $this->colunas = $this->nomeDasColunas($this->table);

        // verifica se tem permissão para ver esse módulo
        if(in_array($this->table . "_ver", $_SESSION["permissoesFuncionario"]) == false){
            header("Location: " . BASE_URL . "/home"); 
        }
    }
     
    public function index() {
        $dados['infoFunc'] = $_SESSION;
        $dados["colunas"] = $this->colunas;
        $this->loadTemplate($this->table, $dados);      
    }
    
    public function adicionar() {
        
        if(in_array($this->table. "_add", $_SESSION["permissoesFuncionario"]) == false){
            header("Location: " . BASE_URL . "/" . $this->table); 
        }
        
        $dados['infoFunc'] = $_SESSION;
        
        if(isset($_POST) && !empty($_POST)){
            $this->model->adicionar($_POST);
            header("Location: " . BASE_URL . "/" . $this->table);
        }else{
            $dados["colunas"] = $this->colunas;
            $dados["viewInfo"] = ["title" => "Adicionar"];
            $this->loadTemplate($this->table . "-form", $dados);
        }
    }
    
    public function editar($id) {

        if(in_array($this->table . "_edt", $_SESSION["permissoesFuncionario"]) == false || empty($id) || !isset($id)){
            header("Location: " . BASE_URL . "/" . $this->table); 
        }

        $dados['infoFunc'] = $_SESSION;
        
        if(isset($_POST) && !empty($_POST)){
            $this->model->editar($id, $_POST);
            header("Location: " . BASE_URL . "/" . $this->table); 
        }else{
            $dados["dados"] = $this->model->pegarInfo($id);
            $dados["colunas"] = $this->colunas;
            $dados["viewInfo"] = ["title" => "Editar"];
            $this->loadTemplate($this->table . "-form", $dados);
        }
    }

    public function excluir($id){

        if(in_array($this->table . "_exc", $_SESSION["permissoesFuncionario"]) == false || empty($id) || !isset($id)){
            header("Location: " . BASE_URL . "/" . $this->table); 
        }

        $this->model->excluir($id);

        header("Location: " . BASE_URL . "/" . $this->table);
    }

}   
?>