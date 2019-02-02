<?php

class core {

    private function redirectMessage($partial = "Erro no endereço, você foi redirecionado para o início.") {
        return '
            <div class="alert alert-danger alert-dismissible m-0 rounded-0">
                ' . $partial . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
    }
    
    public function run(){

        $url = '/'.(isset($_GET['q'])?$_GET['q']:'');
        $params = array();
        
        if(!empty($url) && $url != '/'){

           $url = explode("/", $url);
           array_shift($url);
           
           $currentController = $url[0]."Controller";
           array_shift($url);
           
           if(isset($url[0]) && !empty($url[0])){
               $currentAction = $url[0];
               array_shift($url) ;
           }else{
               if (isset($_SESSION["returnMessage"]["show"]) && $_SESSION["returnMessage"]["show"]) {
                   unset($_SESSION["returnMessage"]);
               }
               $currentAction = "index"; 
           }
           
           if(count($url)>0){
               $params = $url;
           }
            
        }else{
            $currentController = "homeController";
            $currentAction = "index";
        }
        
        if (class_exists($currentController)){
            $a = new $currentController(); 
            if(method_exists($a,$currentAction)){
                //echo 'A classe existe e o método tbm!';exit;
            }else{
                //echo 'A classe existe, mas o método NÂO!';exit;  
                echo $this->redirectMessage("Erro no endereço, você foi redirecionado para " .ucfirst(str_replace("Controller","",$currentController)));
                $currentAction = "index";
            }
        }else{
            //echo 'A classe não existe!';exit;
            echo $this->redirectMessage();
            $currentController = "homeController";
            $currentAction = "index";
        }
        ////////////////////////////////////////       
        $c = new $currentController();
        call_user_func_array(array($c,$currentAction), $params);
        
    }    

}

?>