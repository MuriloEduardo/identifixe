<?php
class ajaxController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
    }
     
    public function index() {
       //no index não existe função específica, módulo usado para as requisições ajax    
    } 
    
    /////// cadastro de ADM CARTOES
    public function ConfereNomeAdm(){
      $dados = array();
      $a = new Administradoras();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $a->buscaAdmPeloNome($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    /////// cadastro de ADM CARTOES
    /////// cadastro de LANÇAMENTOS CAIXA
    public function buscaSinteticas(){
      $dados = array();
      $cg = new Contasgerenciais();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $cg->pegarListaSinteticas($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function buscaAnaliticas(){
      $dados = array();
      $cg = new Contasgerenciais();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $idsintetica = trim(addslashes($_POST["q"]));
          $dados = $cg->pegarListaAnaliticas($idsintetica,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function buscaBandeiras(){
      $dados = array();
      $a = new Administradoras();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $idadm = trim(addslashes($_POST["q"]));
          $dados = $a->pegarListaBandeirasAceitas($idadm,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    /////// cadastro de LANÇAMENTOS CAIXA
    /////// cadastro de FORNECEDORES
    public function ConfereNomeFantasia(){
      $dados = array();
      $fr = new Fornecedores();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fr->buscaFornPeloNomeFantasia($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereSigla(){
      $dados = array();
      $fr = new Fornecedores();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fr->buscaFornPelaSigla($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereRazao(){
      $dados = array();
      $fr = new Fornecedores();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fr->buscaFornPelaRazao($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereCnpj(){
      $dados = array();
      $fr = new Fornecedores();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fr->buscaFornPeloCnpj($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    /////// cadastro de FORNECEDORES
    /////// cadastro de FUNCIONARIOS
    public function ConfereNomeFuncionario(){
      $dados = array();
      $fn = new Funcionarios();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fn->buscaFuncPeloNome($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereEmailFuncionario(){
      $dados = array();
      $fn = new Funcionarios();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fn->buscaFuncPeloEmail($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereCpfFuncionario(){
      $dados = array();
      $fn = new Funcionarios();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $fn->buscaFuncPeloCPF($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    public function SalvaSenhaNova(){
      $resp = array();
      $fn = new Funcionarios();
      
      if( isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["senha1"]) && !empty($_POST["senha1"]) && $_POST["senha2"] && !empty($_POST["senha2"])){
          $idselec = $senhavelha = trim(addslashes($_POST["id"]));
          $senhavelha = trim(addslashes($_POST["senha1"]));
          $senhanova = trim(addslashes($_POST["senha2"]));
          $resp = $fn->novaSenhaSalva($idselec,$senhavelha,$senhanova,$_SESSION["idEmpresaFuncionario"]);
      }
      //testar redirecionar daqui!
      echo json_encode($resp);
    }
    /////// cadastro de FUNCIONARIOS
    /////// CONTROLE FLUXO DE CAIXA
    public function quitarItens(){
      $resp = array();
      $lc = new Lancamentos();
      
      if( isset($_POST["ids"]) && !empty($_POST["ids"]) && isset($_POST["valtot"]) && !empty($_POST["valtot"]) && isset($_POST["dtquit"]) && !empty($_POST["dtquit"]) && isset($_POST["alters"]) && !empty($_POST["alters"])){
          $ids = $_POST["ids"];
          $valtots = $_POST["valtot"];
          $alteracoes = $_POST["alters"];
          $dtquit = $_POST["dtquit"];
          $resp = $lc->quitarItensAbertos($ids,$valtots,$dtquit,$alteracoes,$_SESSION["idEmpresaFuncionario"]);
      }
      //testar redirecionar daqui!
      
      echo json_encode($resp);
    }
    
    public function editarItem(){
      $resp = array();
      $lc = new Lancamentos();
      
      if( !empty($_POST["info"])){
          $info = $_POST["info"];
          $resp = $lc->editarItem($info,$_SESSION["idEmpresaFuncionario"]);
      }      
      echo json_encode($resp);
    }
    /////// CONTROLE FLUXO DE CAIXA
    
/////// CADASTRO DE CLIENTES
    public function ConfereNomeCliente(){
      $dados = array();
      $cl = new Clientes();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $cl->buscaClientePeloNome($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereEmailCliente(){
      $dados = array();
      $cl = new Clientes();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $cl->buscaClientePeloEmail($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    public function ConfereCpfCliente(){
      $dados = array();
      $cl = new Clientes();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $cl->buscaClientePeloCPF($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
   
    /////// CADASTRO DE CLIENTES
    
    /////// ESTOQUE
    public function buscaProdutosFornecedor(){
      $dados = array();
      $st = new Estoque();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $st->buscaProdsForn($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
        
    public function ConfereCodProd(){
       $dados = array();
       $st = new Estoque();
       if(isset($_POST["codigo"]) && !empty($_POST["codigo"]) && isset($_POST["fornecedor"]) && !empty($_POST["fornecedor"])){
           $cod = trim(addslashes($_POST["codigo"]));
           $forn = trim(addslashes($_POST["fornecedor"]));
           $dados = $st->buscaCodigoProduto($cod, $forn,$_SESSION["idEmpresaFuncionario"]);
       }
       echo json_encode($dados);
     }
     
    public function adicionarItem(){
       $resp = array();
       $st = new Estoque();
       //print_r($_POST["info"]);exit;
       if(isset($_POST["info"]) && !empty($_POST["info"])){
           $infos = $_POST["info"];
           $resp = $st->adicionar($infos,$_SESSION["idEmpresaFuncionario"]);
       }
       echo json_encode($resp);
     }
     
    public function excluirItens(){
      $resp = array();
      $st = new Estoque();
      
      if( isset($_POST["ids"]) && !empty($_POST["ids"]) && isset($_POST["alters"]) && !empty($_POST["alters"])){
          $ids = $_POST["ids"];
          $alteracoes = $_POST["alters"];
          $resp = $st->excluirItens($ids,$alteracoes,$_SESSION["idEmpresaFuncionario"]);
      }
      //testar redirecionar daqui!
      
      echo json_encode($resp);
    }
    
    public function editarItemEstoque(){
      $resp = array();
      $st = new Estoque();
      
      if( !empty($_POST["info"])){
          $info = $_POST["info"];
          $resp = $st->editarItem($info,$_SESSION["idEmpresaFuncionario"]);
      }      
      echo json_encode($resp);
    }
    /////// ESTOQUE
    
    /////// CADASTRO DE SERVIÇOS
    public function ConfereNomeServico(){
      $dados = array();
      $sv = new Servicos();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $sv->buscaServicoPeloNome($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
   
    /////// COMPRAS

    public function ConfereQtdEstoque(){
      $st = new Estoque();
      if(isset($_POST["q"]) && !empty($_POST["q"])){
          $nome = trim(addslashes($_POST["q"]));
          $dados = $st->confereEstoque($nome,$_SESSION["idEmpresaFuncionario"]);
      }
      echo json_encode($dados);
    }
    
    /////// PRODUTOS
    public function buscaProdutos(){
        $prod = new Produtos();
               
        $dados = $prod->buscaProdutos();
        
        echo json_encode($dados);
      }
    
}   
?>

