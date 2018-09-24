<link href="<?php echo BASE_URL;?>/assets/css/funcionarios.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/funcionarios.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>

<h1 class="titulo_fn">ADICIONAR FUNCIONÁRIO</h1>
<div class="input-pai">
    <div class="input-filho"><input type="button" value="Limpar Campos" class="botao_fnAux" onclick="limparPreenchimento()"/></div>
</div>
<form method="POST">
   
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[1]" id="itxt1" placeholder='<?php echo $listaColunas[2]["nomecol"];?>' class="input-block" required style="width: 98%"/>
        </div>
    </div>    
    <div class="input-pai">
        <div class="input-filho"><input type="email" name="txt[2]" id="itxt2" placeholder='<?php echo $listaColunas[3]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[3]" id="itxt3" placeholder='<?php echo $listaColunas[4]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[4]" id="itxt4" placeholder='<?php echo $listaColunas[5]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[5]" id="itxt5" placeholder='<?php echo $listaColunas[6]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[6]" id="itxt6" placeholder='<?php echo $listaColunas[7]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[7]" id="itxt7" placeholder='<?php echo $listaColunas[8]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[8]" id="itxt8" placeholder='<?php echo $listaColunas[9]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[9]" id="itxt9" placeholder='<?php echo $listaColunas[10]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[10]" id="itxt10" placeholder='<?php echo $listaColunas[11]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[11]" id="itxt11" placeholder='<?php echo $listaColunas[12]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[12]" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" id="itxt12" placeholder='<?php echo $listaColunas[13]["nomecol"];?>' class="input-block" required/>
        </div>
        <div class="input-filho">
            <input type="hidden" name="txt[13]" id="itxt13" class="input-block" />
            <select id="itxt14" name="txt[14]" class="select-block" required>
                <option value="" selected disabled>Grupos de Permissão</option>
                    <?php foreach ($listaGruposPerm as $gp):?>
                        <option value="<?php echo $gp["id"]?>" ><?php echo ucwords($gp["nome"]);?></option>
                    <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[16]" id="itxt16" placeholder='<?php echo $listaColunas[17]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[17]" id="itxt17" placeholder='<?php echo $listaColunas[18]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="txt[18]" id="itxt18" placeholder='<?php echo $listaColunas[19]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="txt[19]" id="itxt19" placeholder='<?php echo $listaColunas[20]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><textarea name="txt[15]" id="itxt15" placeholder='<?php echo $listaColunas[16]["nomecol"];?>' class="select-block"></textarea></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="password" name="senha1" id="senha1" placeholder='Digite sua Senha' class="input-block" required /></div>
        <div class="input-filho"><input type="password" name="txt[20]" id="itxt20" placeholder='Repita sua Senha' class="input-block" required/></div>
    </div>    
    <div class="input-pai"><div class="input-filho">
        <input type="submit" value="Adicionar" class="botao_fn" onclick="return testeEnvio()"/>
    </div></div>    

</form>
<div style="clear: both"></div>


