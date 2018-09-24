<link href="<?php echo BASE_URL;?>/assets/css/fornecedores.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/fornecedores.js" type="text/javascript"></script>
<h1 class="titulo_fr">FORNECEDORES</h1>

<div class="aviso_fr"><?php if(!empty($aviso)){echo $aviso;}?></div>
<div class="input-pai"><div class="input-filho">
    <?php if(in_array("fornecedores_add", $infoFunc["permissoesFuncionario"])):?>
        <a href="<?php echo BASE_URL;?>/fornecedores/adicionar" class="botao_fr">Adicionar</a>
    <?php endif;?>
</div></div>
    
    
    <div class="input-pai">
        <div class="input-filho">
            <label class="label-block"> Procurar Por:
                <select class="select-block" id="icampo">
                    <option value="">Todos As Colunas</option>
                    <?php for($i = 2; $i< count($listaColunas)-2; $i++):?>
                    <option value="<?php echo ($i-1);?>"><?php echo $listaColunas[$i]['nomecol']?></option>
                <?php endfor;?>
                </select>
            </label>    
        </div>
        <div class="input-filho">            
            <label class="label-block" for="ifiltro">Texto Procurado:<input type="text" id="ifiltro" class="input-block" /></label>
        </div>
    </div>

    <table id="tabelafornecedores" class="display nowrap" cellspacing="0"  style="width: 100%" >
    <thead>
        <tr>
            <th>Ações</th>
            <?php for($i = 2; $i< count($listaColunas)-2; $i++):?>
                <th><?php echo $listaColunas[$i]['nomecol']?></th>
            <?php endfor;?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaFornecedores as $chave => $valor ):?>
            <tr>
                <td width="100px">
                    <?php if(in_array("fornecedores_edt", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/fornecedores/editar/<?php echo $valor["id"];?>" class="botao_peq_fr">Editar</a>
                    <?php endif;?>
                    <?php if(in_array("fornecedores_exc", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/fornecedores/excluir/<?php echo $valor["id"];?>" class="botao_peq_fr" onclick="return confirm('Tem Certeza?')">Excluir</a>
                    <?php endif;?>
                </td>

                <?php for($col = 2; $col < count($listaColunas)-2; $col++):?>
                <td><?php echo utf8_decode(ucwords($listaFornecedores[$chave][$col]));?></td>
                <?php endfor;?>              
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div style="clear: both"></div>




