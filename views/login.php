<!DOCTYPE html>    
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title><?php echo NOME_EMPRESA;?></title>
        <link href="<?php echo BASE_URL;?>/assets/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="loginarea">
            <h1>Login</h1>
            <?php if(!empty($aviso)):?>
            <div class="aviso"><?php echo $aviso;?></div><br><br>
            <?php endif;?>
            <form method="POST">
                <input type="email" name="email" placeholder="E-mail"/>
                <input type="password" name="senha" placeholder="Senha"/>
                <input type="submit" value="Entrar"/>
            </form>
            <div style="clear: both"></div>
        </div>
    </body>
</html>
 



