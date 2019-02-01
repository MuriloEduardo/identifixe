<?php
class loginController extends controller{
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {

        $dados = array(
            "aviso" => ""
        );

        if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["senha"])){
          
            $email = addslashes($_POST["email"]);
            $senha = md5(addslashes($_POST["senha"]));
            
            $funcionario = new Funcionarios();
            
            if($funcionario->fazerLogin($email,$senha)){
               header("Location: ".BASE_URL."/home");
               exit;
            }else{
                $dados["aviso"] = "E-mail e/ou senha incorretos.";
            }
        }
 
        $this->loadView("login",$dados);
    }
    
    public function sair() {
        if(isset($_SESSION["idFuncionario"]) && !empty($_SESSION["idFuncionario"]) && isset($_SESSION["permissoesFuncionario"]) && !empty($_SESSION["permissoesFuncionario"])){
            $_SESSION["nomeFuncionario"] = "";
            $_SESSION["idFuncionario"] = "";
            $_SESSION["emailFuncionario"] = "";
            $_SESSION["idEmpresaFuncionario"] = "";
            $_SESSION["empresaFuncionario"] = "";
            $_SESSION["permissoesFuncionario"] = "";
            unset($_SESSION);
            header("Location: ".BASE_URL."/login");    
        }
    }
}
?>