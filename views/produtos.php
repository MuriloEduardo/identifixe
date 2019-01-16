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
                <h1 class="display-4">Produtos</h1>
            </div>
            <div class="col text-right">
                <?php if(in_array("produtos_add", $infoFunc["permissoesFuncionario"])):?>
                    <a href="<?php echo BASE_URL;?>/produtos/adicionar" class="btn btn-success">Adicionar</a>
                <?php endif ?>
            </div>
        </div>
    </header>
    
    <!-- <div class="input-pai">
        <div class="input-filho">
            <label class="label-block"> Procurar Por:
                <select class="select-block" id="icampo">
                    <option value="">Todos As Colunas</option>
                    <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
                    <option value="<?php echo ($i-1);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']))?></option>
                <?php endfor;?>
                </select>
            </label>    
        </div>
        <div class="input-filho">            
            <label class="label-block" for="ifiltro">Texto Procurado:<input type="text" id="ifiltro" class="input-block" /></label>
        </div>
    </div> -->

    <table class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th>Ações</th>
            <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
                <?php if(lcfirst($listaColunas[$i]['tipo']) == 'longtext'):?>
                    <th data-multidim = 'longtext'><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']))?></th>
                <?php else:?>
                    <th><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']))?></th>
                <?php endif;?>
                
            <?php endfor;?>
        </tr>
    </thead>
</table>