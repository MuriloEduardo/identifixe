<?php
class administradorasController extends controller{
    
    protected $modulo = "administradoras";
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
        
        if(in_array("administradoras_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/administradoras"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $a = new Administradoras();
        
        
        if(isset($_POST["nome"]) && !empty($_POST["nome"]) && isset($_POST["bandeira"]) && isset($_POST["infos"]) && isset($_POST["txant"]) && isset($_POST["txcre"])){
            
            $nome = addslashes($_POST["nome"]);
            $bandeiras = $_POST["bandeira"]; //ids de cadastro das bandeiras 
            $informacoes = $_POST["infos"];
            $txantecipacoes = $_POST["txant"];
            $txcreditos = $_POST["txcre"];
            $a->adicionar($nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos);
            header("Location: ".BASE_URL."/administradoras");
        }else{

            $dados["listaBandeiras"] = $a->pegarListaBandeiras();
            $this->loadTemplate("administradoras-add",$dados);
        }  
    }
    
    public function editar($id) {
        if(in_array("administradoras_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/administradoras"); 
        }
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $a = new Administradoras();
        
        $id = addslashes($id); // id da administradora de cartão
        if(isset($_POST["nome"]) && !empty($_POST["nome"]) && isset($_POST["bandeira"]) && isset($_POST["infos"]) && isset($_POST["txant"]) && isset($_POST["txcre"])){
            
            $nome = addslashes($_POST["nome"]); //nome da administradora
            $bandeiras = $_POST["bandeira"]; // [idCadBandAceitas] => [idCadBandeiras]
            $informacoes = $_POST["infos"];
            $txantecipacoes = $_POST["txant"];
            $txcreditos = $_POST["txcre"];
            $alter = addslashes($_POST["alter"]);
            
            $a->editar($id, $nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos,$alter);
            header("Location: ".BASE_URL."/administradoras");
        }else{
            
            $dados["infoAdm"] = $a->pegarInfoAdm($id);
            $dados["listaBandeiras"] = $a->pegarListaBandeiras();
            $dados["bandeirasAceitas"] = $a->pegarBandeirasAceitas($id);
            $this->loadTemplate("administradoras-edt",$dados);
        } 

    }

    public function excluir($id) {
        if(in_array("administradoras_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/administradoras"); 
        }
        
        $a = new Administradoras();
        $id = addslashes($id);

        $a->excluir($id);
        header("Location: ".BASE_URL."/administradoras");  
      }
    }   
  
?>