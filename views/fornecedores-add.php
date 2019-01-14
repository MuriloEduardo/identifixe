<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<h1 class="titulo_fr">ADICIONAR FORNECEDOR</h1>
<form method="POST">

    <input type="reset" value="Limpar Campos" class="botao_frAux"/>
   
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="nome_fantasia" id="itxt1" placeholder='<?php echo $listaColunas[2]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="sigla" id="itxt2" placeholder='<?php echo $listaColunas[3]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[3]" id="itxt3" placeholder='<?php echo $listaColunas[4]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="cnpj" id="itxt4" placeholder='<?php echo $listaColunas[5]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="cep" id="itxt5" placeholder='<?php echo $listaColunas[6]["nomecol"];?>' class="input-block" /></div>
        <div class="input-filho"><input type="text" name="txt[6]" id="itxt6" placeholder='<?php echo $listaColunas[7]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[7]" id="itxt7" placeholder='<?php echo $listaColunas[8]["nomecol"];?>' class="input-block" /></div>
        <div class="input-filho"><input type="text" name="txt[8]" id="itxt8" placeholder='<?php echo $listaColunas[9]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[9]" id="itxt9" placeholder='<?php echo $listaColunas[10]["nomecol"];?>' class="input-block" /></div>
        <div class="input-filho"><input type="text" name="txt[10]" id="itxt10" placeholder='<?php echo $listaColunas[11]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[11]" id="itxt11" placeholder='<?php echo $listaColunas[12]["nomecol"];?>' class="input-block" /></div>
        <div class="input-filho"><input type="text" name="txt[12]" id="itxt12" placeholder='<?php echo $listaColunas[13]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[13]" id="itxt13" placeholder='<?php echo $listaColunas[14]["nomecol"];?>' class="input-block" /></div>
        <div class="input-filho"><input type="text" name="txt[14]" id="itxt14" placeholder='<?php echo $listaColunas[15]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><textarea name="txt[15]" id="itxt15" placeholder='<?php echo $listaColunas[16]["nomecol"];?>' class="select-block"></textarea></div>
    </div>
    
    <div class="input-pai"><div class="input-filho">
        <input type="submit" value="Adicionar" class="botao_fr" onclick="return testeEnvio()"/>
    </div></div>    

</form>
<div style="clear: both"></div>


