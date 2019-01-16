<link href="<?php echo BASE_URL;?>/assets/css/admcartoes.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/admcartoes.js" type="text/javascript"></script>
<h1 class="titulo_adm">ADMINISTRADORAS DE CARTÃO</h1>

<div class="aviso_pm"><?php if(!empty($aviso)){echo $aviso;}?></div>
<?php if(in_array("admcartoes_add", $infoFunc["permissoesFuncionario"])):?>
    <a href="<?php echo BASE_URL;?>/admcartoes/adicionar" class="botao_adm">Adicionar</a>
<?php endif;?>
    
       
    <table id="iadms" class="display nowrap" cellspacing="0"  style="width: 100%">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Administradoras</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaAdministradoras as $p):?>
            <tr>
                <td>
                    <?php if(in_array("admcartoes_edt", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/admcartoes/editar/<?php echo $p["id"];?>" class="botao_peq_adm">Editar</a>
                    <?php endif;?>
                    <?php if(in_array("admcartoes_exc", $infoFunc["permissoesFuncionario"])):?>
                        <a href="<?php echo BASE_URL;?>/admcartoes/excluir/<?php echo $p["id"];?>" class="botao_peq_adm" onclick="return confirm('Tem Certeza?')">Excluir</a>
                    <?php endif;?>
                </td>
                <td><?php echo ucfirst($p["nome"]);?></td>
            </tr>
            <?php endforeach;?>
    </tbody>
</table>