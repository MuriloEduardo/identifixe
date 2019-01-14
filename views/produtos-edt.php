<link href="<?php echo BASE_URL;?>/assets/css/servicos.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/produtos.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>

<h1 class="titulo_sv">Editar PRODUTO</h1>


<form method="POST" class="formulario">
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
                            data-ant='<?php echo  ucfirst($infoSelecionado[0][lcfirst($listaColunas[$i]['nomecol'])]);?>' 
                            >
                            
                            <option value="" selected > Selecione <?php echo ucfirst($listaColunas[$i]['nomecol']);?></option>    
                        <?php for($j = 0; $j < count($listaColunas[$i]['relacional']); $j++):?>
                            <option value="<?php echo $listaColunas[$i]['relacional'][$j]['nome'];?>" 
                                <?php if(ucfirst($infoSelecionado[0][lcfirst($listaColunas[$i]['nomecol'])]) == $listaColunas[$i]['relacional'][$j]['nome']):?>
                                    selected
                                <?php endif;?>
                            ><?php echo $listaColunas[$i]['relacional'][$j]['nome'];?></option>
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
                        data-ant='<?php echo  ucfirst($infoSelecionado[0][lcfirst($listaColunas[$i]['nomecol'])]);?>' 
                    >
                        <?php echo  ucfirst($infoSelecionado[0][lcfirst($listaColunas[$i]['nomecol'])]);?> 
                    </textarea>
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
                        value='<?php echo  ucfirst($infoSelecionado[0][lcfirst($listaColunas[$i]['nomecol'])]);?>' 
                        data-ant='<?php echo  ucfirst($infoSelecionado[0][lcfirst($listaColunas[$i]['nomecol'])]);?>' 
                    />
                </div>
            </div>    
        <?php endif;?>
    <?php endfor;?>

    <input
        type="hidden"  
        name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>" 
        id="<?php echo 'itxt'.($i);?>"
        value='<?php echo  ucfirst($infoSelecionado[0][lcfirst($listaColunas[count($listaColunas)-2]['nomecol'])]);?>' 
        required                        
    />

    <div class="input-pai">
        <div class="input-filho">
            <input type="submit" value="Salvar" class="botao_sv" onclick="return testeEnvio1()"/>
        </div>
    </div>    

</form>
<div style="clear: both"></div>


