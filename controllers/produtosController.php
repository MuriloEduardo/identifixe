<?php
class produtosController extends controller{
    
    public $modulo = 'produtos';
    
    public function __construct() {
        parent::__construct();
        
       $func = new Funcionarios();
       
       //verifica se está logado
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
       //verifica se tem permissão para ver esse módulo
       if(in_array($this->modulo."_ver",$_SESSION["permissoesFuncionario"]) == FALSE){
           header("Location: ".BASE_URL."/home"); 
       }
    }

     
    public function index() {
        $dados = array();
        $dados['infoFunc'] = $_SESSION;
        
        $prod = new Produtos();
        
        $dados["listaColunas"] = $prod->nomeDasColunas();
        $dados["listaProdutos"]  = $prod->pegarListaProdutos();
        $this->loadTemplate($this->modulo,$dados);      
    } 
    
    public function adicionar() {
        
        if(in_array($this->modulo."_add",$_SESSION["permissoesFuncionario"]) == FALSE){
            header("Location: ".BASE_URL."/".$this->modulo); 
        }

        $prod = new Produtos();

        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $listaColunas = $prod->nomeDasColunas();
        $camposAdd = Array();

        if(isset($_POST[lcfirst($listaColunas[1]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[1]['nomecol'])])){
            $cont=0;
            for ($i = 1; $i < count($listaColunas) - 2; $i++ ){
                if($listaColunas[$i]['nulo'] == "NO"){
                    $cont++;
                    if(isset($_POST[lcfirst($listaColunas[$i]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[$i]['nomecol'])])){
                        $camposAdd[$i] =  $_POST[lcfirst($listaColunas[$i]['nomecol'])];
                    }    
                }
            }
            
            // testar se esta salvando os campos que não são obrigatorios
            if (!empty($camposAdd) && count($camposAdd) == $cont ){
                $camposForm = Array();
                for($j=1; $j <= count($_POST); $j++){
                    $camposForm[$j] = $_POST[lcfirst($listaColunas[$j]['nomecol'])];
                }

                $prod->adicionar($camposForm,$listaColunas);
                header("Location: ".BASE_URL."/".$this->modulo);
            }else{
                $dados["listaColunas"] = $prod->nomeDasColunas();
                $this->loadTemplate($this->modulo."-add",$dados);
            }
        }else{
            $dados["listaColunas"] = $prod->nomeDasColunas();
            $this->loadTemplate($this->modulo."-add",$dados);
        }    
    }
    
    public function editar($id) {
        if(in_array($this->modulo."_edt",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/".$this->modulo); 
        }

        $prod = new Produtos();
        
        $array = array();
        $dados['infoFunc'] = $_SESSION;
        $listaColunas = $prod->nomeDasColunas();
        $camposAdd = Array();
        $id = addslashes($id);

        if(isset($_POST[lcfirst($listaColunas[1]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[1]['nomecol'])])){
             
            $cont = 0;
            for ($i = 1; $i < count($listaColunas) - 2; $i++ ){
                if($listaColunas[$i]['nulo'] == "NO"){
                    $cont++;
                    if(isset($_POST[lcfirst($listaColunas[$i]['nomecol'])]) || !empty($_POST[lcfirst($listaColunas[$i]['nomecol'])])){
                        $camposAdd[$i] =  $_POST[lcfirst($listaColunas[$i]['nomecol'])];
                    }    
                }
            }
            
            
            if (!empty($camposAdd) && count($camposAdd) == $cont ){
                
                $camposForm = Array();
                for($j=1; $j <= count($_POST); $j++){
                    $camposForm[$j] = $_POST[lcfirst($listaColunas[$j]['nomecol'])];
                }

                $prod->editar($camposForm,$listaColunas, $id);
                header("Location: ".BASE_URL."/".$this->modulo);
            }else{
                $dados["listaColunas"] = $prod->nomeDasColunas();
                $this->loadTemplate($this->modulo."-edt",$dados);
            }
        }else{
            
            $dados["idSelecionado"] = $id;
            $dados["infoSelecionado"] = $prod->pegarInfo($id);
            $dados["listaColunas"] = $prod->nomeDasColunas();

            $this->loadTemplate($this->modulo."-edt",$dados);
        }
        
    }

    public function excluir($id) {       
        if(in_array($this->modulo."_exc",$_SESSION["permissoesFuncionario"]) == FALSE || empty($id) || !isset($id)){
            header("Location: ".BASE_URL."/".$this->modulo); 
        }
        
        $prod = new Produtos();
        $id = addslashes($id);
        
        $prod->excluir($id);
        header("Location: ".BASE_URL."/".$this->modulo);  
      }
    
}   
?>