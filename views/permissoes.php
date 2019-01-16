<link href="<?php echo BASE_URL;?>/assets/css/permissoes.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/permissoes.js" type="text/javascript"></script>
<h1 class="titulo_pm">PERMISSÕES</h1>

<div class="aviso_pm"><?php if(!empty($aviso)){echo $aviso;}?></div>
<?php if(in_array("permissoes_add", $infoFunc["permissoesFuncionario"])):?>
    <a href="<?php echo BASE_URL;?>/permissoes/adicionar_grupo" class="botao_pm">Adicionar</a>
<?php endif;?>

    <table id="igrupos" class="display nowrap" cellspacing="0"  style="width: 100%">
    <thead>
        <tr>
            <th>Ações</th>
            <th>Grupo Permissão</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaGrupoPermissoes as $p):?>
        <tr>
            <td>
                <?php if(in_array("permissoes_edt", $infoFunc["permissoesFuncionario"])):?>
                    <a href="<?php echo BASE_URL;?>/permissoes/editarGrupo/<?php echo $p["id"];?>" class="botao_peq_pm">Editar</a>
                <?php endif;?>
                <?php if(in_array("permissoes_exc", $infoFunc["permissoesFuncionario"])):?>
                    <a href="<?php echo BASE_URL;?>/permissoes/excluirGrupo/<?php echo $p["id"];?>" class="botao_peq_pm" onclick="return confirm('Tem Certeza?')">Excluir</a>
                <?php endif;?>
            </td>
            <td><?php echo ucfirst($p["nome"]);?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>