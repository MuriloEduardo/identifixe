<?php
$modulo = str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php"));
$headerData = [
    "titulo" => "Permissões"
];
require "_header_browser.php";
require "_table_datatable.php";
?>
<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo $modulo ?>'
</script>