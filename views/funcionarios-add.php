<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<h1 class="titulo_fn">ADICIONAR FUNCIONÁRIO</h1>
<div class="input-pai">
    <div class="input-filho"><input type="button" value="Limpar Campos" class="botao_fnAux" onclick="limparPreenchimento()"/></div>
</div>
<form method="POST">
   
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="nome" id="itxt1" placeholder='<?php echo $listaColunas[2]["nomecol"];?>' class="input-block" required style="width: 98%"/>
        </div>
    </div>    
    <div class="input-pai">
        <div class="input-filho"><input type="email" name="email" id="itxt2" placeholder='<?php echo $listaColunas[3]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="cpf" id="itxt3" placeholder='<?php echo $listaColunas[4]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="rg" id="itxt3" placeholder='<?php echo $listaColunas[5]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="cep" id="itxt4" placeholder='<?php echo $listaColunas[5]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="endereco" id="itxt5" placeholder='<?php echo $listaColunas[6]["nomecol"];?>' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="numero" id="itxt6" placeholder='<?php echo $listaColunas[7]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="complemento" id="itxt7" placeholder='<?php echo $listaColunas[8]["nomecol"];?>' class="input-block" /></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="bairro" id="itxt8" placeholder='<?php echo $listaColunas[9]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="data" id="itxt9" placeholder='data' class="input-block" required/></div>
    </div>
    <div class="input-pai">
        <div class="input-filho"><input type="text" name="telefone" id="itxt10" placeholder='<?php echo $listaColunas[11]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="celular" id="itxt11" placeholder='<?php echo $listaColunas[12]["nomecol"];?>' class="input-block" required/></div>
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
        <div class="input-filho"><input type="text" name="salario" id="itxt16" placeholder='<?php echo $listaColunas[17]["nomecol"];?>' class="input-block" required/></div>
        <div class="input-filho"><input type="text" name="comissao" id="itxt17" placeholder='<?php echo $listaColunas[18]["nomecol"];?>' class="input-block" required/></div>
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