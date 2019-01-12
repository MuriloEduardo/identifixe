<link href="<?php echo BASE_URL;?>/assets/css/servicos.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/produtos.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>

<h1 class="titulo_sv">ADICIONAR PRODUTO</h1>

// e se a piroca for select como resolve??
<form method="POST" class="formulario">
    <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
        <div class="form_linha">
            <div class="form_itemLinha">
                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']));?></label>
                <input
                    type="text"  
                    name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>" 
                    id="<?php echo 'itxt'.($i);?>"
                    <?php if($listaColunas[$i]['nulo'] == "NO"):?>
                        required                  
                    <?php endif;?> 
                />
            </div>
        </div>
    <?php endfor;?>

    <div class="input-pai">
        <div class="input-filho">
            <input type="submit" value="Adicionar" class="botao_sv" onclick="return testeEnvio1()"/>
        </div>
    </div>    

</form>
<div style="clear: both"></div>


