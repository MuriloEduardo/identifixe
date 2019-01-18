<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>
<!-- header -->
<?php
$headerData = [
    "titulo" => "Fornecedores",
    "adicionar" => [
        "permissao" => "fornecedores_add",
        "url" => "/fornecedores/adicionar"
    ]
];
require "_header_browser.php";
?>
<!-- end header -->
<table id="tabelafornecedores" class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th class="actions">Ações</th>
            <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
                <th>
                    <span><?php echo $listaColunas[$i]['nomecol']?></span>
                    <i class="small text-muted fas fa-sort ml-2"></i>
                </th>
            <?php endfor;?>
        </tr>
    </thead>
</table>