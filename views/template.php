<?php
   $menus = array(
      [
         "text" => "Home",
         "icon" => "fas fa-home",
         "permissao" => "home",
         "link" => "/home"
      ],
      [
         "text" => "Permissões",
         "icon" => "fas fa-ban",
         "permissao" => "permissoes_ver",
         "link" => "/permissoes"
      ],
      [
         "text" => "Administradoras de Cartão",
         "icon" => "fas fa-credit-card",
         "permissao" => "admcartoes_ver",
         "link" => "/admcartoes"
      ],
      [
         "text" => "Lançamentos de Caixa",
         "icon" => "fas fa-cart-plus",
         "permissao" => "lancamentos_ver",
         "link" => "/lancamentos"
      ],
      [
         "text" => "Fornecedores",
         "icon" => "fas fa-truck",
         "permissao" => "fornecedores_ver",
         "link" => "/fornecedores"
      ],
      [
         "text" => "Funcionários",
         "icon" => "fas fa-users",
         "permissao" => "funcionarios_ver",
         "link" => "/funcionarios"
      ],
      [
         "text" => "Controle de Caixa",
         "icon" => "fas fa-calculator",
         "permissao" => "controlecaixa_ver",
         "link" => "/controlecaixa"
      ],
      [
         "text" => "Clientes",
         "icon" => "fas fa-handshake",
         "permissao" => "clientes_ver",
         "link" => "/clientes"
      ],
      [
         "text" => "Estoque",
         "icon" => "fas fa-box-open",
         "permissao" => "estoque_ver",
         "link" => "/estoque"
      ],
      [
         "text" => "Compras",
         "icon" => "fas fa-shopping-basket",
         "permissao" => "compras_ver",
         "link" => "/compras"
      ],
      [
         "text" => "Produtos",
         "icon" => "fas fa-boxes",
         "permissao" => "produtos_ver",
         "link" => "/produtos"
      ]
   );
?>
<!doctype html>
<html class="h-100">
   <head>
      <title>Painel - <?php echo NOME_EMPRESA;?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link href="<?php echo BASE_URL;?>/assets/css/vendor/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="<?php echo BASE_URL;?>/assets/css/vendor/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
      <link href="<?php echo BASE_URL;?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
   </head>
   <body class="d-flex flex-column h-100">
      <nav class="navbar navbar-dark bg-primary shadow-sm fixed-top">
         <ul class="nav">
            <li>
               <a href="#menu-toggle" class="btn btn-link text-white" id="menu-toggle">
                  <span class="navbar-toggler-icon"></span>
               </a>
            </li>
            <li>
               <a class="navbar-brand mx-3" href="#"><?php echo trim(NOME_EMPRESA);?></a>
            </li>
         </ul>
         <ul class="navbar-nav">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo ucfirst($infoFunc["nomeFuncionario"]);?>
               </a>
               <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" onclick="return confirm('Confirmar sua saída?')" href="<?php echo BASE_URL;?>/login/sair">Sair</a>
               </div>
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <aside id="sidebar-wrapper" class="shadow-lg bg-dark">
            <ul class="nav flex-column sidebar-nav p-3">
               <?php foreach ($menus as $key => $value): ?>
                  <?php if($value["permissao"] == "home" || in_array("permissoes_ver", $infoFunc["permissoesFuncionario"])): ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . $value["link"];?>" class="">
                           <i class="<?php echo $value["icon"] ?> mr-3"></i>
                           <span><?php echo $value["text"] ?></span>
                        </a>
                     </li>
                  <?php endif ?>
               <?php endforeach ?>
            </ul>
         </aside>
         <main id="page-content-wrapper">
            <div class="container-fluid">
               <?php $this->loadViewInTemplate($viewName, $viewData); ?>
            </div>
         </main>
      </div>
      <footer class="py-3 bg-light mt-auto shadow-sm">
         <div class="container-fluid">
            <div class="text-muted text-center">Todos os direitos reservados <strong>SqualoAquile</strong><br/>Estamos à disposição: <a href="mailto:contato@squaloaquile.com.br">contato@squaloaquile.com.br</a></div>
         </div>
      </footer>
   </body>
   <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery-3.3.1.min.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery.mask.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL;?>/assets/js/vendor/jquery-ui.min.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL;?>/assets/js/vendor/popper.min.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL;?>/assets/js/vendor/bootstrap.min.js" type="text/javascript"></script>
   <script src="<?php echo BASE_URL;?>/assets/js/main.js" type="text/javascript"></script>
</html>