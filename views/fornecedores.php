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
    
    
    <!-- <div class="input-pai">
        <div class="input-filho">
            <label class="label-block"> Procurar Por:
                <select class="select-block" id="icampo">
                    <option value="">Todos As Colunas</option>
                    <?php for($i = 2; $i< count($listaColunas)-2; $i++):?>
                    <option value="<?php echo ($i-1);?>"><?php echo $listaColunas[$i]['nomecol']?></option>
                <?php endfor;?>
                </select>
            </label>    
        </div>
        <div class="input-filho">            
            <label class="label-block" for="ifiltro">Texto Procurado:<input type="text" id="ifiltro" class="input-block" /></label>
        </div>
    </div> -->

    <table id="tabelafornecedores" class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th>Ações</th>
            <?php for($i = 2; $i< count($listaColunas)-2; $i++):?>
                <th><?php echo $listaColunas[$i]['nomecol']?></th>
            <?php endfor;?>
        </tr>
    </thead>
    </table>