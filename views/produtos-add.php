<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<h1 class="display-4">Adicionar Produto</h1>

<form method="POST">
    <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
        <?php if($listaColunas[$i]['tipo'] == 'mediumtext'):?>
            <div class="form-group">
                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']));?></label>
                <select id="<?php echo 'itxt'.($i);?>" 
                        name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>"
                        class="form-control"
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
        <?php elseif($listaColunas[$i]['tipo'] == 'text'):?>
            <div class="form-group">
                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']));?></label>
                <textarea
                    class="form-control"
                    name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>" 
                    id="<?php echo 'itxt'.($i);?>"
                    <?php if($listaColunas[$i]['nulo'] == "NO"):?>
                        required                  
                    <?php endif;?>
                >
                </textarea>
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
            <div class="form-group">
                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']));?></label>
                <input
                    type="text" 
                    class="form-control" 
                    name="<?php echo lcfirst($listaColunas[$i]['nomecol']);?>" 
                    id="<?php echo 'itxt'.($i);?>"
                    <?php if($listaColunas[$i]['nulo'] == "NO"):?>
                        required                  
                    <?php endif;?> 
                />
            </div>
        <?php endif;?>
    <?php endfor;?>

    <input type="submit" value="Adicionar" class="btn btn-primary" onclick="return testeEnvio1()"/>

</form>