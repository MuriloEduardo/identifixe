<link href="<?php echo BASE_URL;?>/assets/css/permissoes.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/permissoes.js" type="text/javascript"></script>
<h1 class="titulo_pm">EDITAR GRUPO</h1>


<form method="POST">
   
    <input type="text" name="enome" id="inome" placeholder="Nome do Grupo" class="input-100" value="<?php echo $permAtivas["nome"];?>" required/><br/>
    
    <label class="label-100">Permissões</label><br/>  
        
        
    <table class="table_pm">
        <tr>
            <th>Ver</th>
            <th>Adicionar</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php for($i=0;$i<= count($listaPermissoes)-3;$i+=4):?>
        <tr>
            <td>
                <input type="checkbox" name='epermissoes[]' value="<?php echo $listaPermissoes[$i+0]["id"];?>" id="p_<?php echo $listaPermissoes[$i+0]["id"];?>" <?php echo (in_array($listaPermissoes[$i+0]["id"], $permAtivas["params"]))?'checked="checked"':'';?>/>
                <label for="p_<?php echo $listaPermissoes[$i+0]["id"];?>"><?php echo $listaPermissoes[$i+0]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='epermissoes[]' value="<?php echo $listaPermissoes[$i+1]["id"];?>" id="p_<?php echo $listaPermissoes[$i+1]["id"];?>" <?php echo (in_array($listaPermissoes[$i+1]["id"], $permAtivas["params"]))?'checked="checked"':'';?>/>
                <label for="p_<?php echo $listaPermissoes[$i+1]["id"];?>"><?php echo $listaPermissoes[$i+1]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='epermissoes[]' value="<?php echo $listaPermissoes[$i+2]["id"];?>" id="p_<?php echo $listaPermissoes[$i+2]["id"];?>" <?php echo (in_array($listaPermissoes[$i+2]["id"], $permAtivas["params"]))?'checked="checked"':'';?>/>
                <label for="p_<?php echo $listaPermissoes[$i+2]["id"];?>"><?php echo $listaPermissoes[$i+2]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='epermissoes[]' value="<?php echo $listaPermissoes[$i+3]["id"];?>" id="p_<?php echo $listaPermissoes[$i+3]["id"];?>" <?php echo (in_array($listaPermissoes[$i+3]["id"], $permAtivas["params"]))?'checked="checked"':'';?>/>
                <label for="p_<?php echo $listaPermissoes[$i+3]["id"];?>"><?php echo $listaPermissoes[$i+3]["nome"];?></label><br/>
            </td>
        </tr>  
        <?php endfor;?>
        <tr>
            <td>
                <input type="checkbox" name='epermissoes[]' value="<?php echo $listaPermissoes[count($listaPermissoes)-2]["id"];?>" id="p_<?php echo $listaPermissoes[count($listaPermissoes)-2]["id"];?>" <?php echo (in_array($listaPermissoes[count($listaPermissoes)-2]["id"], $permAtivas["params"]))?'checked="checked"':'';?>/>
                <label for="p_<?php echo $listaPermissoes[count($listaPermissoes)-2]["id"];?>"><?php echo $listaPermissoes[count($listaPermissoes)-2]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='epermissoes[]' value="<?php echo $listaPermissoes[count($listaPermissoes)-1]["id"];?>" id="p_<?php echo $listaPermissoes[count($listaPermissoes)-1]["id"];?>" <?php echo (in_array($listaPermissoes[count($listaPermissoes)-1]["id"], $permAtivas["params"]))?'checked="checked"':'';?>/>
                <label for="p_<?php echo $listaPermissoes[count($listaPermissoes)-1]["id"];?>"><?php echo $listaPermissoes[count($listaPermissoes)-1]["nome"];?></label><br/>
            </td>

        </tr>

    </table><br/>
    <textarea name="alter" id="ialter" class="alter"  readonly="readonly"><?php echo $permAtivas["alteracoes"];?></textarea><br/>
    
    <input type="submit" value="Editar" class="botao_pm" onclick="return confirm('Tem certeza?')"/>
   
</form>