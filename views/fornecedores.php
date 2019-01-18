<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<h1 class="display-4">Fornecedores</h1>

<?php if(!empty($aviso)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <?php echo $aviso ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>

<?php if(in_array("fornecedores_add", $infoFunc["permissoesFuncionario"])): ?>
    <a href="<?php echo BASE_URL;?>/fornecedores/adicionar" class="btn btn-success">Adicionar</a>
<?php endif ?>
    

    <table id="tabelafornecedores" class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th>Ações</th>
            <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
                <th><?php echo $listaColunas[$i]['nomecol']?></th>
            <?php endfor;?>
        </tr>
    </thead>
    </table>