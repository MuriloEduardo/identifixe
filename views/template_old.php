<!DOCTYPE html>
<html>
    <head>
        <title>PAINEL - <?php echo NOME_EMPRESA;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link href="<?php echo BASE_URL;?>/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        
        <link href="<?php echo BASE_URL;?>/assets/css/template.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL;?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
        

        <!-- JAVASCRIPT -->
        <script src="<?php echo BASE_URL;?>/assets/js/jquery-3.2.0.min.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL;?>/assets/js/jquery.mask.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL;?>/assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <script src="<?php echo BASE_URL;?>/assets/js/template.js" type="text/javascript"></script>
    </head>
    <body>
        <!-- Aqui COMEÇA as configurações do MENU SUPERIOR------->
        <div class="navegacao">
            <div class="botaomenu">
                <img src="<?php echo BASE_URL;?>/assets/images/menu.png" alt="lista Menu" border="0" width="30" height="30"/>
            </div>
            <div class="marcaempresa">
                <div class="logoimg">
                    <img src="<?php echo BASE_URL;?>/assets/images/relatorios.png" alt="Logo da Empresa" border="0" width="50" height="40"/>
                </div>
                <div class="nomeempresa">
                    <?php echo trim(NOME_EMPRESA);?>
                </div>
            </div>
            <div class="botaosair" onclick="return confirm('Confirmar sua saída?')">
                <a href="<?php echo BASE_URL;?>/login/sair"><img src="<?php echo BASE_URL;?>/assets/images/sair.png" alt="Botão de Sair" border="0" width="30" height="30"></a>
            </div>
        </div>
        <!-- Aqui TERMINA --------------------------------------->
        <!-- Aqui começa as configurações do MENU DESCE E SOBE--->
        <div class="menufixo">
            <p class="logado1">Bem Vindo!</p>
            <p class="logado"><span class="icon-user"></span> <?php echo ucfirst($infoFunc["nomeFuncionario"]);?></p>
            <ul>
                <li class="submenu"><a href="<?php echo BASE_URL;?>/home"><span class="icon-home3"></span> home</a></li>
                <?php if(in_array("permissoes_ver", $infoFunc["permissoesFuncionario"])):?>
                <li class="submenu"><a href="<?php echo BASE_URL;?>/permissoes"><span class="icon-key"></span> permissoes</a></li>
                <?php endif;?>
                <?php if(in_array("admcartoes_ver", $infoFunc["permissoesFuncionario"])):?>
                <li class="submenu"><a href="<?php echo BASE_URL;?>/admcartoes"><span class="icon-coin-dollar"></span> administradoras de cartão</a></li>
                <?php endif;?>
                <?php if(in_array("lancamentos_ver", $infoFunc["permissoesFuncionario"])):?>
                <li class="submenu"><a href="<?php echo BASE_URL;?>/lancamentos"><span class="icon-price-tags"></span> lançamentos Caixa</a></li>
                <?php endif;?>
                <?php if(in_array("fornecedores_ver", $infoFunc["permissoesFuncionario"])):?>
                <li class="submenu"><a href="<?php echo BASE_URL;?>/fornecedores"><span class="icon-key"></span> fornecedores</a></li>
                <?php endif;?>
            </ul>    
            <div style="clear: both"></div>
        </div>
        <script>
            var baselink = '<?php echo BASE_URL;?>';
        </script>
        <!-- Aqui TERMINA --------------------------------------->
        <!-- Aqui começa as configurações do CONTEUDO ----------->
        <div class="conteudo">
            <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            <div style="clear: both"></div>
        </div>
        <!-- Aqui TERMINA --------------------------------------->       
        <!-- Aqui começa as configurações do rodapé -->
        <div class="rodape">
            <p>Todos os direitos reservados <strong>SqualoAquile</strong><br/>Estamos à disposição: contato@squaloaquile.com.br</p>
        </div>
        <!-- Aqui começa as configurações do rodapé -->
    </body>
</html>


