<link href="<?php echo BASE_URL;?>/assets/css/funcionarios.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/funcionarios.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>


<h1 class="titulo_fn">EDITAR FUNCIONÁRIO</h1>
<div class="input-pai">
    <div class="input-filho"><input type="button" value="Limpar Campos" class="botao_fnAux" onclick="limparPreenchimento()"/></div>
</div>
<form method="POST" data-idselec="<?php echo $idSelecionado;?>">
   
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[1]" id="itxt1" placeholder='<?php echo $listaColunas[2]["nomecol"];?>' class="input-block" required style="width: 98%" value="<?php echo  ucfirst($infoFuncionario[0][2]);?>"/>
        </div>
    </div>    
    <div class="input-pai">
        <div class="input-filho"><input type="email" name="txt[2]" id="itxt2" placeholder='<?php echo $listaColunas[3]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][3]);?>"/></div>
        <div class="input-filho"><input type="text" name="txt[3]" id="itxt3" placeholder='<?php echo $listaColunas[4]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][4]);?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[4]" id="itxt4" placeholder='<?php echo $listaColunas[5]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][5]);?>"/></div>
        <div class="input-filho"><input type="text" name="txt[5]" id="itxt5" placeholder='<?php echo $listaColunas[6]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][6]);?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[6]" id="itxt6" placeholder='<?php echo $listaColunas[7]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][7]);?>"/></div>
        <div class="input-filho"><input type="text" name="txt[7]" id="itxt7" placeholder='<?php echo $listaColunas[8]["nomecol"];?>' class="input-block" value="<?php echo ucfirst($infoFuncionario[0][8]);?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[8]" id="itxt8" placeholder='<?php echo $listaColunas[9]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][9]);?>"/></div>
        <div class="input-filho"><input type="text" name="txt[9]" id="itxt9" placeholder='<?php echo $listaColunas[10]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][10]);?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[10]" id="itxt10" placeholder='<?php echo $listaColunas[11]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][11]);?>"/></div>
        <div class="input-filho"><input type="text" name="txt[11]" id="itxt11" placeholder='<?php echo $listaColunas[12]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][12]);?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[12]" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" id="itxt12" placeholder='<?php echo $listaColunas[13]["nomecol"];?>' class="input-block" required value="<?php echo ucfirst($infoFuncionario[0][13]);?>"/>
        </div>
        <div class="input-filho">
            <input type="hidden" name="txt[13]" id="itxt13" class="input-block" value="<?php echo ucfirst($infoFuncionario[0][14]);?>"/>
            <select id="itxt14" name="txt[14]" class="select-block" required>
                <option value="" selected disabled>Grupos de Permissão</option>
                    <?php foreach ($listaGruposPerm as $gp):?>
                        <option value="<?php echo $gp["id"]?>" <?php if($gp["id"]==$infoFuncionario[0][15]){echo "selected='selected'";};?>><?php echo ucwords($gp["nome"]);?></option>
                    <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[16]" id="itxt16" placeholder='<?php echo $listaColunas[17]["nomecol"];?>' class="input-block" required                                                  value="<?php echo floatval(str_replace(".", ",",$infoFuncionario[0][17]));?>"/></div>
        <div class="input-filho"><input type="text" name="txt[17]" id="itxt17" placeholder='<?php echo $listaColunas[18]["nomecol"];?>' class="input-block" required                                               value="<?php echo floatval(str_replace(".", ",",$infoFuncionario[0][18]));?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[18]" id="itxt18" placeholder='<?php echo $listaColunas[19]["nomecol"];?>' class="input-block" required                                                 value="<?php echo floatval(str_replace(".", ",",$infoFuncionario[0][19]));?>"/></div>
        <div class="input-filho"><input type="text" name="txt[19]" id="itxt19" placeholder='<?php echo $listaColunas[20]["nomecol"];?>' class="input-block" required                                               value="<?php echo floatval(str_replace(".", ",",$infoFuncionario[0][20]));?>"/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><textarea name="txt[15]" id="itxt15" placeholder='<?php echo $listaColunas[16]["nomecol"];?>' class="select-block"><?php echo ucwords($infoFuncionario[0][16]);?></textarea></div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <textarea name="txt[21]" id="itxt21" class="select-block"  style="background-color: #DDD" readonly="readonly"><?php echo ucfirst($infoFuncionario[0][22]);?></textarea></div>
    </div>
    
    <div class="input-pai">
        <div class="input-filho">
            <div class="botao_fnAux" style="height: 30px; line-height: 30px; float: right;" id="ibtnsenha"> Alterar Senha</div>
        </div>       
    </div>
    <div id="ialtsenha" style="display: none">
        <div class="input-pai">
            <div class="input-filho"><input type="password" name="senhaantiga" id="senhaantiga" placeholder='Digite sua Senha Antiga' class="input-block" /></div>
            <div class="input-filho"><input type="password" name="senhanova1" id="senhanova1" placeholder='Digite sua Senha Nova' class="input-block" /></div>
            <div class="input-filho"><input type="password" name="senhanova2" id="senhanova2" placeholder='Repita sua Senha Nova' class="input-block" /></div>
        </div>
        <div class="input-pai">
            <div class="input-filho">
                <div class="botao_fnAux" style="height: 40px;line-height: 40px" onclick="salvaSenha()"> Salvar Nova Senha</div>
            </div>       
        </div>
    </div>    
    <div class="input-pai"><div class="input-filho">
        <input type="submit" value="Editar" class="botao_fn" onclick="return testeEnvio()"/>
    </div></div>    

</form>
<script>
    var valoresfunc = new Array();
        valoresfunc = <?php echo json_encode($infoFuncionario);?>;  
</script>
<div style="clear: both"></div>
