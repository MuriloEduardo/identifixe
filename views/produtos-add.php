<link href="<?php echo BASE_URL;?>/assets/css/servicos.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<h1 class="titulo_sv">ADICIONAR PRODUTO</h1>


<form method="POST" class="formulario" >
    <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
        <?php if($listaColunas[$i]['tipo'] == 'mediumtext'):?>
        <div class="form_linha">
            <div class="form_itemLinha">
                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']));?></label>
                <select id="<?php echo 'itxt'.($i);?>" 
                        name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>"
                        <?php if($listaColunas[$i]['nulo'] == "NO"):?>
                            required                  
                        <?php endif;?> 
                        >
                        
                        <option value="" selected > Selecione <?php echo ucfirst($listaColunas[$i]['nomecol']);?></option>    
                    <?php for($j = 0; $j < count($listaColunas[$i]['relacional']); $j++):?>
                        <option value="<?php echo $listaColunas[$i]['relacional'][$j]['nome'];?>" ><?php echo $listaColunas[$i]['relacional'][$j]['nome'];?></option>
                    <?php endfor;?>     
                </select>
            </div>
        </div>
        <?php elseif($listaColunas[$i]['tipo'] == 'text'):?>
            <div class="form_linha">
                <div class="form_itemLinha">
                    <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']));?></label>
                    <textarea
                        name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>" 
                        id="<?php echo 'itxt'.($i);?>"
                        <?php if($listaColunas[$i]['nulo'] == "NO"):?>
                            required                  
                        <?php endif;?>
                    >
                    </textarea>
                </div>
            </div>
        <?php elseif($listaColunas[$i]['tipo'] == 'longtext'):?>
            <div class="form_linha">
                <div class="form_itemLinha">
                    <input
                        type="hidden"  
                        name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>" 
                        id="<?php echo 'itxt'.($i);?>"
                        value=''                         
                    />
                </div>                
            </div>        
        <?php else:?>
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
        <?php endif;?>
    <?php endfor;?>

    <div class="input-pai">
        <div class="input-filho">
            <input type="submit" value="Adicionar" class="botao_sv" onclick="return testeEnvio1()"/>
        </div>
    </div>    

</form>
<div style="clear: both"></div>


