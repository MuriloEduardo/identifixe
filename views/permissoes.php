<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<?php if(!empty($aviso)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <?php echo $aviso ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>

<header class="pt-4 pb-5">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="display-4">Permissões</h1>
        </div>
        <div class="col text-right">
            <?php if(in_array("permissoes_add", $infoFunc["permissoesFuncionario"])):?>
                <a href="<?php echo BASE_URL;?>/permissoes/adicionar_grupo" class="btn btn-success">Adicionar</a>
            <?php endif ?>
        </div>
    </div>
</header>

<table id="igrupos" class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th>Ações</th>
            <th>Grupo Permissão</th>
        </tr>
    </thead>
</table>