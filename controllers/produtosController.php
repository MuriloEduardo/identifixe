<?php
class produtosController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array("produtos_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }
     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        
        $prod = new Produtos();
        
        $dados["listaColunas"] = $prod->nomeDasColunas();
        $dados["listaProdutos"]  = $prod->pegarListaProdutos();
        //print_r($dados); exit;
        $this->loadTemplate("produtos",$dados);      
    } 
    
    public function adicionar() {
        
        if(in_array("produtos_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/produtos"); 
        }

        $prod = new Produtos();

        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $listaColunas = $prod->nomeDasColunas();
        $camposAdd = Array();

        

        if(isset($_POST[lcfirst($listaColunas[1]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[1]['nomecol'])])){
            for ($i = 1; $i < count($listaColunas) - 2; $i++ ){
                if($listaColunas[$i]['nulo'] == "NO"){
                    $nomevar = lcfirst($listaColunas[$i]['nomecol']);
                    if(isset($_POST[lcfirst($listaColunas[$i]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[$i]['nomecol'])])){
                        $camposAdd[$i] =  $_POST[lcfirst($listaColunas[$i]['nomecol'])];
                    }    
                }
            }
            
            // testar se esta salvando os campos que não são obrigatorios
            if (!empty($camposAdd) && count($camposAdd) > 0 ){
                $camposForm = Array();
                for($j=1; $j <= count($_POST); $j++){
                    $camposForm[$j] = $_POST[lcfirst($listaColunas[$j]['nomecol'])];
                }
                // print_r($camposForm);exit;

                $prod->adicionar($camposForm,$listaColunas);
                header("Location: ".BASE_URL."/produtos");
            }else{
                $dados["listaColunas"] = $prod->nomeDasColunas();
                $this->loadTemplate("produtos-add",$dados);
            }
        }else{
            $dados["listaColunas"] = $prod->nomeDasColunas();
            $this->loadTemplate("produtos-add",$dados);
        }    
    }
    
    public function editar($id) {
        if(in_array("produtos_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/produtos"); 
        }

        $prod = new Produtos();

        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $listaColunas = $prod->nomeDasColunas();
        $camposAdd = Array();
        $id = addslashes($id);

        //----------------------------------------

        if(isset($_POST[lcfirst($listaColunas[1]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[1]['nomecol'])])){
            for ($i = 1; $i < count($listaColunas) - 2; $i++ ){
                if($listaColunas[$i]['nulo'] == "NO"){
                    $nomevar = lcfirst($listaColunas[$i]['nomecol']);
                    if(isset($_POST[lcfirst($listaColunas[$i]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[$i]['nomecol'])])){
                        $camposAdd[$i] =  $_POST[lcfirst($listaColunas[$i]['nomecol'])];
                    }    
                }
            }
            
            // testar se esta salvando os campos que não são obrigatorios
            if (!empty($camposAdd) && count($camposAdd) > 0 ){
                $camposForm = Array();
                for($j=1; $j <= count($_POST); $j++){
                    $camposForm[$j] = $_POST[lcfirst($listaColunas[$j]['nomecol'])];
                }
                // print_r($camposForm);exit;

                $prod->adicionar($camposForm,$listaColunas);
                header("Location: ".BASE_URL."/produtos");
            }else{
                $dados["listaColunas"] = $prod->nomeDasColunas();
                $this->loadTemplate("produtos-add",$dados);
            }
        }else{
            
            $dados["idSelecionado"] = $id;
            $dados["infoSelecionado"] = $prod->pegarInfo($id);
            $dados["listaColunas"] = $prod->nomeDasColunas();

             //print_r($dados); exit;
            //print_r($dados["infoSelecionado"]); exit;
            $this->loadTemplate("produtos-edt",$dados);
        }
        // //----------------------------------------
        
    }








    public function excluir($id) {       
        if(in_array("servicos_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/servicos"); 
        }
        
        $sv = new Servicos();
        $id = addslashes($id);
        
        $sv->excluir($id,$_SESSION["idEmpresaFuncionario"]);
        header("Location: ".BASE_URL."/servicos");  
      }
    
}   
?>

