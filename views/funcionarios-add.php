
<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>


<header class="d-flex align-items-center my-5">
    <?php if(in_array("funcionarios_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/funcionarios' ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0">Adicionar Funcionário</h1>
</header>

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
                        
                        <option value="" selected >Selecione</option>
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

