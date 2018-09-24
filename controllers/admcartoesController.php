<?php
class admcartoesController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("admcartoes_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        
        $a = new Administradoras();
        $dados["listaAdministradoras"]  = $a->pegarListaAdministradoras($_SESSION["idEmpresaFuncionario"]);
        $this->loadTemplate("admcartoes",$dados);      
    } 
    
    public function adicionar() {
        
        if(in_array("admcartoes_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/admcartoes"); 
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
            $a->adicionar($nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/admcartoes");
        }else{

            $dados["listaBandeiras"] = $a->pegarListaBandeiras($_SESSION["idEmpresaFuncionario"]);
            $this->loadTemplate("admcartoes-add",$dados);
        }  
    }
    
    public function editar($id) {
        if(in_array("admcartoes_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/admcartoes"); 
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
            
            $a->editar($id, $nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos,$alter,$_SESSION["idEmpresaFuncionario"]);
            header("Location: ".BASE_URL."/admcartoes");
        }else{
            
            $dados["infoAdm"] = $a->pegarInfoAdm($id,$_SESSION["idEmpresaFuncionario"]);
            $dados["listaBandeiras"] = $a->pegarListaBandeiras($_SESSION["idEmpresaFuncionario"]);
            $dados["bandeirasAceitas"] = $a->pegarBandeirasAceitas($id,$_SESSION["idEmpresaFuncionario"]);
            $this->loadTemplate("admcartoes-edt",$dados);
        } 

    }

    public function excluir($id) {
        if(in_array("admcartoes_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/admcartoes"); 
        }
        
        $a = new Administradoras();
        $id = addslashes($id);

        $a->excluir($id,$_SESSION["idEmpresaFuncionario"]);
        header("Location: ".BASE_URL."/admcartoes");  
      }
    }   
  
?>

