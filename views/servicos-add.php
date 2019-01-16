<link href="<?php echo BASE_URL;?>/assets/css/servicos.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/servicos.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>

<h1 class="titulo_sv">ADICIONAR SERVIÇO</h1>


<form method="POST" class="formulario">
    <div class="form_linha">
        <div class="form_itemLinha">
            <label for="itxt1"><?php echo ucwords(str_replace("_", " ", $listaColunas[2]['nomecol']));?></label>
            <input type="text" name="txt[1]" id="itxt1" data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[2]['tipo']));?>' required/>
        </div>
               
        <div class="form_itemLinha">
            <label for="itxt2"><?php echo ucwords(str_replace("_", " ", $listaColunas[3]['nomecol']));?></label>
            <input type="text" name="txt[2]" id="itxt2" data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[3]['tipo']));?>' required/>
        </div>
    </div>
    <div class="form_linha">
        <div class="form_itemLinha">
            <label for="itxt3"><?php echo ucwords(str_replace("_", " ", $listaColunas[4]['nomecol']));?></label>
            <textarea name="txt[3]" id="itxt3" data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[4]['tipo']));?>'></textarea>
        </div>              
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="submit" value="Adicionar" class="botao_sv" onclick="return confirm('Deseja adicionar o Item?')"/>
        </div>
    </div>    

</form>