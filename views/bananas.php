<?php
// Transforma o nome do arquivo para o nome do módulo
$modulo = str_replace("-form", "", basename(__FILE__, ".php"));

// Constroi o cabeçalho
require "_header_browser.php";
// Constroi a tabela
require "_table_datatable.php";
?>
<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = 'clientes'
</script>