<?php
class dashboardController extends controller{
    public function __construct() {
        parent::__construct();
    
       $func = new Funcionarios();
       
       if($func->isLogged() == false){
           header("Location: ".BASE_URL."/login"); 
       }
        
    }
     
    public function index() {
      $dados = array();
      
      $dados['infoFunc'] = $_SESSION;
      $this->loadTemplate("dashboard",$dados); 
    }
  
}
?>