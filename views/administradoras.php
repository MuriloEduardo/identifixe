<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>
<!-- header -->
<?php
$headerData = [
    "titulo" => "Administradoras de Cartão",
    "adicionar" => [
        "permissao" => "admcartoes_add",
        "url" => "/administradoras/adicionar"
    ]
];
require "_header_browser.php";
?>
<!-- end header -->
<table class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th class="actions">Ações</th>
            <th>
                <span>Administradoras</span>
                <i class="small text-muted fas fa-sort ml-2"></i>
            </th>
        </tr>
    </thead>
</table>