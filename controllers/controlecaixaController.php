<?php
class controlecaixaController extends controller{

    protected $table = "clientes";
    
    protected $shared;

    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       $this->shared = new Shared($this->table);
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("controlecaixa_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
         
    public function index() {
        
        if(in_array("controlecaixa_ver",$_SESSION["permissoesFuncionario"]) == FALSE || in_array("controlecaixa_edt",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/home"); 
        }
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $a = new Administradoras();
        $cc = new Contascorrentes();
        $fp = new Formaspgto();
        $lc = new Lancamentos();

        $dados["listaAdministradoras"]  = $this->shared->pegarListas("administradoras");
        $dados["listaContasCorrentes"]  = $cc->pegarListaCC($_SESSION["idEmpresaFuncionario"]);
        $dados["listaFormasPgto"]  = $fp->pegarListaFormasPgto($_SESSION["idEmpresaFuncionario"]);
        $dados["listaColunas"] = $lc->nomeDasColunas();
        $dados["listaLancamentosAbertos"]  = $lc->pegarListaLancamentoAbertos($_SESSION["idEmpresaFuncionario"]);
        $this->loadTemplate("controlecaixa",$dados);
          
    }
    
//    public function editar($id) {
//        if(in_array("administradoras_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
//            header("Location: ".BASE_URL."/admcartoes"); 
//        }
//        $array = array();
//        $dados['infoFunc'] = $_SESSION;
//        $a = new Administradoras();
//        
//        $id = addslashes($id); // id da administradora de cartão
//        if(isset($_POST["nome"]) && !empty($_POST["nome"]) && isset($_POST["bandeira"]) && isset($_POST["infos"]) && isset($_POST["txant"]) && isset($_POST["txcre"])){
//            
//            $nome = addslashes($_POST["nome"]); //nome da administradora
//            $bandeiras = $_POST["bandeira"]; // [idCadBandAceitas] => [idCadBandeiras]
//            $informacoes = $_POST["infos"];
//            $txantecipacoes = $_POST["txant"];
//            $txcreditos = $_POST["txcre"];
//            $alter = addslashes($_POST["alter"]);
//            
//            $a->editar($id, $nome,$bandeiras,$informacoes,$txantecipacoes,$txcreditos,$alter,$_SESSION["idEmpresaFuncionario"]);
//            header("Location: ".BASE_URL."/admcartoes");
//        }else{
//            
//            $dados["infoAdm"] = $a->pegarInfoAdm($id,$_SESSION["idEmpresaFuncionario"]);
//            $dados["listaBandeiras"] = $a->pegarListaBandeiras($_SESSION["idEmpresaFuncionario"]);
//            $dados["bandeirasAceitas"] = $a->pegarBandeirasAceitas($id,$_SESSION["idEmpresaFuncionario"]);
//            $this->loadTemplate("admcartoes-edt",$dados);
//        } 
//
//    }

//    public function excluir($id) {
//        if(in_array("administradoras_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
//            header("Location: ".BASE_URL."/admcartoes"); 
//        }
//        
//        $a = new Administradoras();
//        $id = addslashes($id);
//
//        $a->excluir($id,$_SESSION["idEmpresaFuncionario"]);
//        header("Location: ".BASE_URL."/admcartoes");  
//      }
    }   
  
?>

