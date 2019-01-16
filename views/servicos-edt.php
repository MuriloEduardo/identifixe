<link href="<?php echo BASE_URL;?>/assets/css/servicos.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/servicos.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>


<h1 class="titulo_sv">EDITAR SERVIÇO</h1>

<form method="POST" data-idselec="<?php echo $idSelecionado;?>" class="formulario">
    <div class="form_linha">
        <div class="form_itemLinha">
            <label for="itxt1"><?php echo ucwords(str_replace("_", " ", $listaColunas[2]['nomecol']));?></label>
            <input type="text" name="txt[1]" id="itxt1" required
                   data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[2]['tipo']));?>' 
                                          value='<?php echo  ucfirst($infoServico[0][2]);?>' 
                                               data-ant='<?php echo  $infoServico[0][2];?>' />
        </div>
        <div class="form_itemLinha">
            <label for="itxt2"><?php echo ucwords(str_replace("_", " ", $listaColunas[3]['nomecol']));?></label>
            <input type="text" name="txt[2]" id="itxt2" required
                   data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[3]['tipo']));?>'
                                    value='<?php echo  number_format($infoServico[0][3],2,",",".");?>'       
                                               data-ant='<?php echo  $infoServico[0][3];?>' />
        </div>
    </div>
    <div class="form_linha">
        <div class="form_itemLinha">
            <label for="itxt3"><?php echo ucwords(str_replace("_", " ", $listaColunas[4]['nomecol']));?></label>
            <textarea name="txt[3]" id="itxt3" 
                      data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[4]['tipo']));?>'
                                                  data-ant='<?php echo  $infoServico[0][4];?>'><?php echo  ucfirst($infoServico[0][4]);?></textarea>
        </div>              
    </div>
    <div class="form_linha">
        <div class="form_itemLinha">
            <label for="itxt4"><?php echo ucwords(str_replace("_", " ", $listaColunas[5]['nomecol']));?></label>
            <textarea name="txt[4]" id="itxt4" readonly="readonly" style="background-color: #DDD"
                      data-tipo='<?php echo ucwords(str_replace("_", " ", $listaColunas[5]['tipo']));?>'><?php echo  ucfirst($infoServico[0][5]);?></textarea>
        </div>              
    </div>

    <div class="input-pai">
        <div class="input-filho">
            <input type="submit" value="Editar" class="botao_sv" onclick="return confirm('Deseja editar o Item?')"/>
        </div>
    </div>    

</form>