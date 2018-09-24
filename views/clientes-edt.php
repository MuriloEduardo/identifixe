<link href="<?php echo BASE_URL;?>/assets/css/clientes.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/clientes.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>


<h1 class="titulo_cl">EDITAR CLIENTE</h1>

<div class="input-pai">
    <div class="input-filho">
        <div class="radio-50">
            <label for="ipf"><input type="radio" id="ipf" name="pessoa" value="pf" checked="checked"/>Pessoa Física</label>
        </div> 
        <div class="radio-50">
            <label for="ipj"><input type="radio" id="ipj" name="pessoa" value="pj"/>Pessoa Jurídica</label>
        </div>
        <input type="button" value="Limpar Campos" class="botao_clAux" onclick="limparPreenchimento()"/><br/>
    </div>
</div>
<form method="POST" data-idselec="<?php echo $idSelecionado;?>">
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[1]" id="itxt1" class="input-block" required 
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[2]['nomecol']));?>' 
                                            value="<?php echo  ucfirst($infoCliente[0][2]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][2];?>' />
        </div>
        <div class="input-filho">
            <input type="text" name="txt[2]" id="itxt2" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[3]['nomecol']));?>'  
                                            value="<?php echo  ucfirst($infoCliente[0][3]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][3];?>'/>
        </div>
    </div>    
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[3]" id="itxt3" class="input-block" 
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[4]['nomecol']));?>' 
                                            value="<?php echo  ucfirst($infoCliente[0][4]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][4];?>'/>
        </div>
        <div class="input-filho">
            <input type="text" name="txt[4]" id="itxt4" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[5]['nomecol']));?>'  
                                            value="<?php echo  ucfirst($infoCliente[0][5]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][5];?>'/>
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[5]" id="itxt5" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[6]['nomecol']));?>'  
                                            value="<?php echo  ucfirst($infoCliente[0][6]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][6];?>'/>
        </div>
        <div class="input-filho">
            <input type="email" name="txt[6]" id="itxt6" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[7]['nomecol']));?>'  
                                            value="<?php echo  ucfirst($infoCliente[0][7]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][7];?>'/>
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[7]" id="itxt7" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[8]['nomecol']));?>'  
                                            value="<?php echo  ucfirst($infoCliente[0][8]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][8];?>'/>
        </div>
        <div class="input-filho">
            <input type="text" name="txt[8]" id="itxt8" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[9]['nomecol']));?>'   
                                            value="<?php echo  ucfirst($infoCliente[0][9]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][9];?>'/>
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[9]" id="itxt9" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[10]['nomecol']));?>'   
                                            value="<?php echo  ucfirst($infoCliente[0][10]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][10];?>'/>
        </div>
        <div class="input-filho">
            <input type="text" name="txt[10]" id="itxt10" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[11]['nomecol']));?>'   
                                            value="<?php echo  ucfirst($infoCliente[0][11]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][11];?>'/>
        </div>
    </div>
    
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[11]" id="itxt11" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[12]['nomecol']));?>'   
                                            value="<?php echo  ucfirst($infoCliente[0][12]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][12];?>'/>
        </div>
        <div class="input-filho">
            <input type="text" name="txt[12]" id="itxt12" class="input-block"
                   placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[13]['nomecol']));?>'   
                                            value="<?php echo  ucfirst($infoCliente[0][13]);?>" 
                                                 data-ant='<?php echo  $infoCliente[0][13];?>'/>
        </div>
    </div>

    <div class="input-pai">
        <div class="input-filho">
            <textarea name="txt[13]" id="itxt13" class="select-block"
                      placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[14]['nomecol']));?>'  
                      data-ant='<?php echo  $infoCliente[0][14];?>'> <?php echo  ucfirst($infoCliente[0][14]);?></textarea>
        </div>
        
        <input type="hidden" name="txt[14]" id="itxt14" 
               placeholder="<?php echo ucwords(str_replace("_", " ", $listaColunas[15]['nomecol']));?>" value="<?php echo  $infoCliente[0][15];?>" data-ant="<?php echo  $infoCliente[0][15];?>"/> <!--contatos-->
    </div>
    
    <div class="input-pai" id="icontatos"><div class="input-filho">
        <div id="ititulo2"> Contatos da Empresa</div>
        <div style="border: 1px solid #000" id="iconts">
            <div class="input-pai">
                <div class="input-filho">
                    <input type="text" id="inome" placeholder='Nome' class="input-block" data-ident=''/>
                </div>
                <div class="input-filho">
                    <input type="text" id="isetor" placeholder='Setor' class="input-block" />
                </div>
                <div class="input-filho"> 
                    <input type="text" id="icel" placeholder='Celular' class="input-block" />
                </div>
                <div class="input-filho"> 
                    <input type="email" id="iemail" placeholder='E-mail' class="input-block" />
                </div>
                <div class="input-filho">
                    <div class="botao_peq_cl1" onclick="adicionaContato()"> + </div>
                    <div class="botao_peq_cl1" onclick="limpaAux()"> Limp </div>
                </div>
            </div>
           
        </div>   
    </div></div>  
    
    <div class="input-pai">
        <div class="input-filho">
            <textarea  class="select-block"  style="background-color: #DDD" readonly="readonly"><?php echo ucfirst($infoCliente[0][16]);?></textarea>
            <input type="hidden" name="txt[15]" id="itxt15" value="<?php echo  $infoCliente[0][16];?>" data-ant='<?php echo  $infoCliente[0][16];?>'/>
            <input type="hidden" name="txt[16]" id="itxt16" value="" /> <!--alterações feitas do item-->
        </div>
    </div>
    
    <div class="input-pai">
        <div class="input-filho">
            <input type="submit" value="Editar" class="botao_cl" onclick="return testeEnvio()"/>
        </div>
    </div>  
</form>    
<script>
    var valoresCliente= new Array();
        valoresCliente = <?php echo json_encode($infoCliente);?>;  
</script>
<div style="clear: both"></div>
