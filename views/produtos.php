<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

    <h1 class="titulo_sv">Produtos</h1>

<div class="aviso_sv"><?php if(!empty($aviso)){echo $aviso;}?></div>
<div class="input-pai"><div class="input-filho">
    <?php if(in_array("produtos_add", $infoFunc["permissoesFuncionario"])):?>
        <a href="<?php echo BASE_URL;?>/produtos/adicionar" class="botao_sv">Adicionar</a>
    <?php endif;?>
</div></div>
    
    
    <div class="input-pai">
        <div class="input-filho">
            <label class="label-block"> Procurar Por:
                <select class="select-block" id="icampo">
                    <option value="">Todos As Colunas</option>
                    <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
                    <option value="<?php echo ($i-1);?>"><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']))?></option>
                <?php endfor;?>
                </select>
            </label>    
        </div>
        <div class="input-filho">            
            <label class="label-block" for="ifiltro">Texto Procurado:<input type="text" id="ifiltro" class="input-block" /></label>
        </div>
    </div>

    <table id="tabelaservicos" class="display nowrap dataTable" cellspacing="0"  style="width: 100%" >
    <thead>
        <tr>
            <th>Ações</th>
            <?php for($i = 1; $i< count($listaColunas)-2; $i++):?>
                <th><?php echo ucwords(str_replace("_", " ", $listaColunas[$i]['nomecol']))?></th>
            <?php endfor;?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaProdutos as $chave => $valor ):?>
            <tr>
                <td width="100px">
                    <?php if(in_array("produtos_edt", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/produtos/editar/<?php echo $valor["id"];?>" class="botao_peq_sv">Editar</a>
                    <?php endif;?>
                    <?php if(in_array("produtos_exc", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/produtos/excluir/<?php echo $valor["id"];?>" class="botao_peq_sv" onclick="return confirm('Tem Certeza?')">Excluir</a>
                    <?php endif;?>
                </td>

                <?php for($col = 1; $col < count($listaColunas)-2; $col++):?>
                    <?php if($listaColunas[$col]["tipo"] == "date"):?>
                        
                        <?php if(floatval(str_replace("-", "",$listaProdutos[$chave][$col])) == 0):?>
                            <td></td>
                        <?php else:?>
                            <td><?php $dtaux = explode("-",$listaProdutos[$chave][$col]); echo $dtaux[2]."/".$dtaux[1]."/".$dtaux[0];?></td>
                        <?php endif;?> 
                        
                    <?php elseif ($listaColunas[$col]["tipo"] == "float"):?>
                        
                            <td><?php echo number_format($listaProdutos[$chave][$col],2,",",".");?></td>
                        
                    <?php else:?>
                        
                        <td><?php echo ucwords($listaProdutos[$chave][$col]);?></td>
                        
                    <?php endif;?>
                <?php endfor;?>              
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div style="clear: both"></div>




