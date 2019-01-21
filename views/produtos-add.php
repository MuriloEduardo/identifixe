<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>
<header class="d-flex align-items-center my-5">
    <?php if(in_array("produtos_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/produtos' ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0">Adicionar Produto</h1>
</header>
<section class="mb-5">
    <form method="POST">
        <div class="row">
            <?php foreach ($colunas as $key => $value): ?>
                <?php if($value["Comment"]["add"] != "false"): ?>
                    <div class="col-<?php echo isset($value["Comment"]["column"]) ? $value["Comment"]["column"] : "12" ?>">
                        <div class="form-group">
                            <label for="<?php echo 'itxt'.($i);?>"><?php echo !is_null($value["Comment"]["label"]) ? $value["Comment"]["label"] : ucwords(str_replace("_", " ", $value['Field'])) ?></label>
                            <input type="text" class="form-control" name="<?php echo lcfirst($value['Field']);?>" 
                                id="<?php echo 'itxt'.($i);?>"
                                <?php if($value['nulo'] == "NO"):?>
                                    required                  
                                <?php endif;?> 
                            />
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
            </div>
        </div>
    </form>
</section>