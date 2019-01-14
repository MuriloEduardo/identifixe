<link href="<?php echo BASE_URL;?>/assets/css/funcionarios.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo BASE_URL;?>/assets/js/funcionarios.js" type="text/javascript"></script>

<h1 class="titulo_fn">FUNCIONÁRIOS</h1>

<div class="aviso_fn"><?php if(!empty($aviso)){echo $aviso;}?></div>
<div class="input-pai"><div class="input-filho">
    <?php if(in_array("funcionarios_add", $infoFunc["permissoesFuncionario"])):?>
        <a href="<?php echo BASE_URL;?>/funcionarios/adicionar" class="botao_fn">Adicionar</a>
    <?php endif;?>
</div></div>
    
    
    <div class="input-pai">
        <div class="input-filho">
            <label class="label-block"> Procurar Por:
                <select class="select-block" id="icampo">
                    <option value="">Todos As Colunas</option>
                    <?php for($i = 2; $i< count($listaColunas)-7; $i++):?>
                    <option value="<?php echo ($i-1);?>"><?php echo $listaColunas[$i]['nomecol']?></option>
                <?php endfor;?>
                </select>
            </label>    
        </div>
        <div class="input-filho">            
            <label class="label-block" for="ifiltro">Texto Procurado:<input type="text" id="ifiltro" class="input-block" /></label>
        </div>
    </div>

    <table id="tabelafuncionarios" class="display nowrap dataTable" cellspacing="0"  style="width: 100%" >
    <thead>
        <tr>
            <th>Ações</th>
            <?php for($i = 2; $i< count($listaColunas)-7; $i++):?>
                <th><?php echo $listaColunas[$i]['nomecol']?></th>
            <?php endfor;?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaFuncionarios as $chave => $valor ):?>
            <tr>
                <td width="100px">
                    <?php if(in_array("funcionarios_edt", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/funcionarios/editar/<?php echo $valor["id"];?>" class="botao_peq_fn">Editar</a>
                    <?php endif;?>
                    <?php if(in_array("funcionarios_exc", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/funcionarios/excluir/<?php echo $valor["id"];?>" class="botao_peq_fn" onclick="return confirm('Tem Certeza?')">Excluir</a>
                    <?php endif;?>
                </td>

                <?php for($col = 2; $col < count($listaColunas)-7; $col++):?>
                    <?php if($listaColunas[$col]["tipo"] == "date"):?>
                        
                        <td><?php $dtaux = explode("-",$listaFuncionarios[$chave][$col]); echo $dtaux[2]."/".$dtaux[1]."/".$dtaux[0];?></td>
                        
                    <?php elseif ($listaColunas[$col]["tipo"] == "float"):?>
                        
                        <td><?php echo str_replace(".",",",$listaFuncionarios[$chave][$col]);?></td>
                        
                    <?php else:?>
                        
                        <td><?php echo ucwords($listaFuncionarios[$chave][$col]);?></td>
                        
                    <?php endif;?>
                <?php endfor;?>              
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div style="clear: both"></div>




