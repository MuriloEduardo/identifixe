<link href="<?php echo BASE_URL;?>/assets/css/clientes.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/clientes.js" type="text/javascript"></script>
<script type="text/javascript">var baselink = '<?php echo BASE_URL;?>'</script>

<h1 class="titulo_cl">ADICIONAR CLIENTE</h1>

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
<form method="POST">
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[1]" id="itxt1" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[2]['nomecol']));?>' class="input-block" required />
        </div>
        <div class="input-filho">
            <input type="text" name="txt[2]" id="itxt2" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[3]['nomecol']));?>' class="input-block" />
        </div>
    </div>    
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[3]" id="itxt3" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[4]['nomecol']));?>' class="input-block" />
        </div>
        <div class="input-filho">
            <input type="text" name="txt[4]" id="itxt4" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[5]['nomecol']));?>' class="input-block" />
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[5]" id="itxt5" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[6]['nomecol']));?>' class="input-block" />
        </div>
        <div class="input-filho">
            <input type="email" name="txt[6]" id="itxt6" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[7]['nomecol']));?>' class="input-block" />
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[7]" id="itxt7" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[8]['nomecol']));?>' class="input-block" />
        </div>
        <div class="input-filho">
            <input type="text" name="txt[8]" id="itxt8" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[9]['nomecol']));?>' class="input-block" />
        </div>
    </div>
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[9]" id="itxt9" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[10]['nomecol']));?>' class="input-block" />
        </div>
        <div class="input-filho">
            <input type="text" name="txt[10]" id="itxt10" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[11]['nomecol']));?>' class="input-block" />
        </div>
    </div>
    
    <div class="input-pai">
        <div class="input-filho">
            <input type="text" name="txt[11]" id="itxt11" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[12]['nomecol']));?>' class="input-block" />
        </div>
        <div class="input-filho">
            <input type="text" name="txt[12]" id="itxt12" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[13]['nomecol']));?>' class="input-block" />
        </div>
    </div>

    <div class="input-pai">
        <div class="input-filho">
            <textarea name="txt[13]" id="itxt13" placeholder='<?php echo ucwords(str_replace("_", " ", $listaColunas[14]['nomecol']));?>' class="select-block"></textarea>
        </div>
        
        <input type="hidden" name="txt[14]" id="itxt14" value="" />
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
            <input type="submit" value="Adicionar" class="botao_cl" onclick="return testeEnvio1()"/>
        </div>
    </div>    

</form>
<div style="clear: both"></div>


