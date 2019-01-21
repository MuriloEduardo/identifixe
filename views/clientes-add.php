<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>
<script src="<?php echo BASE_URL;?>/assets/js/clientes.js" type="text/javascript"></script>
<header class="d-flex align-items-center my-5">
    <?php if(in_array("clientes_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/clientes' ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0">Adicionar Cliente</h1>
</header>
<?php include "_cadastros_form.php" ?>