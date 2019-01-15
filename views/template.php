<!doctype html>
<html>
   <head>
      <title>Painel - <?php echo NOME_EMPRESA;?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSS -->
      <!-- Vendor -->
      <link href="<?php echo BASE_URL;?>/assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="<?php echo BASE_URL;?>/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
      <!-- Local -->
      <link href="<?php echo BASE_URL;?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
      <!-- JAVASCRIPT -->
      <!-- Vendor -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery.mask.js" type="text/javascript"></script>
      <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Popper.JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <!-- Bootstrap JS -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <!-- Local -->
      <script src="<?php echo BASE_URL;?>/assets/js/main.js" type="text/javascript"></script>
   </head>
   <body>
      <nav class="navbar navbar-dark bg-primary sticky-top">
         <ul class="nav">
            <li>
               <a href="#menu-toggle" class="btn btn-outline-light" id="menu-toggle">
                  <i class="fas fa-bars"></i>
               </a>
            </li>
            <li>
               <a class="navbar-brand mx-3" href="#"><?php echo trim(NOME_EMPRESA);?></a>
            </li>
         </ul>
         <ul class="nav navbar-nav">
            <li class="nav-item">
               <a class="nav-link" onclick="return confirm('Confirmar sua saída?')" href="<?php echo BASE_URL;?>/login/sair">Sair</a>
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <!-- Sidebar -->
         <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
               <li class="sidebar-brand">
                  <a href="#">
                  <?php echo ucfirst($infoFunc["nomeFuncionario"]);?>
                  </a>
               </li>
               <li class="active">
                  <a href="<?php echo BASE_URL;?>/home">Home</a>
               </li>
               <?php if(in_array("permissoes_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/permissoes">Permissões</a>
               </li>
               <?php endif;?>
               <?php if(in_array("admcartoes_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/admcartoes">Administradoras de Cartão</a>
               </li>
               <?php endif;?>
               <?php if(in_array("lancamentos_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/lancamentos">Lançamentos de Caixa</a>
               </li>
               <?php endif;?>
               <?php if(in_array("fornecedores_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/fornecedores">Fornecedores</a>
               </li>
               <?php endif;?>
               <?php if(in_array("funcionarios_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/funcionarios">Funcionários</a>
               </li>
               <?php endif;?>
               <?php if(in_array("controlecaixa_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/controlecaixa">Controle de Caixa</a>
               </li>
               <?php endif;?>
               <?php if(in_array("clientes_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/clientes">Clientes</a>
               </li>
               <?php endif;?>
               <?php if(in_array("estoque_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/estoque">Estoque</a>
               </li>
               <?php endif;?>
               <?php if(in_array("compras_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/compras">Compras</a>
               </li>
               <?php endif;?>
               <?php if(in_array("servicos_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/servicos">Serviços</a>
               </li>
               <?php endif;?>
               <?php if(in_array("produtos_ver", $infoFunc["permissoesFuncionario"])):?>
               <li>
                  <a href="<?php echo BASE_URL;?>/produtos">Produtos</a>
               </li>
               <?php endif;?>
            </ul>
         </div>
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
         <div id="page-content-wrapper">
            <div class="container-fluid">
               <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            </div>
         </div>
         <footer class="py-3 bg-dark">
            <div class="container-fluid">
               <div class="text-muted text-center">Todos os direitos reservados <strong>SqualoAquile</strong><br/>Estamos à disposição: <a href="mailto:contato@squaloaquile.com.br">contato@squaloaquile.com.br</a></div>
            </div>
         </footer>
         <!-- /#page-content-wrapper -->
      </div>
   </body>
</html>