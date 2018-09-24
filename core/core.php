<?php

class core {
    
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
               $currentAction = "index"; 
           }
           
           if(count($url)>0){
               $params = $url;
           }
            
        }else{
            $currentController = "homeController";
            $currentAction = "index";    
        }
        ////////////////////////////////////
//        echo "Controller: ".$currentController."<br/>Action: ".$currentAction."<br/>";
        
        if (class_exists($currentController)){
            $a = new $currentController(); 
            if(method_exists($a,$currentAction)){
                //echo 'A classe existe e o método tbm!';exit;
            }else{
                //echo 'A classe existe, mas o método NÂO!';exit;
                echo "<div style='background-color:#ff7380;height: 50px;line-height: 20px; font-size: 20px;text-align: center; border: 3px solid #000'>Erro no endereço, você foi redirecionado para o início do(a)(s) ".ucfirst(str_replace("Controller","",$currentController)).".</div>";
                 
                $currentAction = "index";
            }
        }else{
            //echo 'A classe não existe!';exit;
            echo "<div style='background-color:#ff7380;height: 50px;line-height: 20px; font-size: 20px;text-align: center; border: 3px solid #000'>Erro no endereço, você foi redirecionado para o início.</div>";
            $currentController = "homeController";
            $currentAction = "index";
        }
        ////////////////////////////////////////       
        $c = new $currentController();           
        call_user_func_array(array($c,$currentAction), $params);
        
    }    

}

?>