<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<header class="d-flex align-items-center my-5">
    <?php if(in_array("permissoes_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/fornecedores' ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0">Adicionar Fornecedor</h1>
</header>

<form method="POST">
   
    <input type="text" name="nome_fantasia" id="itxt1" placeholder='<?php echo $listaColunas[2]["nomecol"];?>' class="form-control" required/>
    <input type="text" name="sigla" id="itxt2" placeholder='<?php echo $listaColunas[3]["nomecol"];?>' class="form-control" required/>
    
    <input type="text" name="txt[3]" id="itxt3" placeholder='<?php echo $listaColunas[4]["nomecol"];?>' class="form-control" required/>
    <input type="text" name="cnpj" id="itxt4" placeholder='<?php echo $listaColunas[5]["nomecol"];?>' class="form-control" />

    <input type="text" name="cep" id="itxt5" placeholder='<?php echo $listaColunas[6]["nomecol"];?>' class="form-control" />
    <input type="text" name="txt[6]" id="itxt6" placeholder='<?php echo $listaColunas[7]["nomecol"];?>' class="form-control" />

    <input type="text" name="txt[7]" id="itxt7" placeholder='<?php echo $listaColunas[8]["nomecol"];?>' class="form-control" />
    <input type="text" name="txt[8]" id="itxt8" placeholder='<?php echo $listaColunas[9]["nomecol"];?>' class="form-control" />

    <input type="text" name="txt[9]" id="itxt9" placeholder='<?php echo $listaColunas[10]["nomecol"];?>' class="form-control" />
    <input type="text" name="txt[10]" id="itxt10" placeholder='<?php echo $listaColunas[11]["nomecol"];?>' class="form-control" />

    <input type="text" name="txt[11]" id="itxt11" placeholder='<?php echo $listaColunas[12]["nomecol"];?>' class="form-control" />
    <input type="text" name="txt[12]" id="itxt12" placeholder='<?php echo $listaColunas[13]["nomecol"];?>' class="form-control" />
    
    <input type="text" name="txt[13]" id="itxt13" placeholder='<?php echo $listaColunas[14]["nomecol"];?>' class="form-control" />
    <input type="text" name="txt[14]" id="itxt14" placeholder='<?php echo $listaColunas[15]["nomecol"];?>' class="form-control" />

    <textarea name="txt[15]" id="itxt15" placeholder='<?php echo $listaColunas[16]["nomecol"];?>' class="form-control"></textarea>
    <input type="submit" value="Adicionar" class="btn btn-primary" onclick="return testeEnvio()"/>

</form>