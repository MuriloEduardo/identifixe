<link href="<?php echo BASE_URL;?>/assets/css/permissoes.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/permissoes.js" type="text/javascript"></script>
<h1 class="titulo_pm">ADICIONAR GRUPO</h1>


<form method="POST">
   
    <input type="text" name="nome" id="inome" placeholder="Nome do Grupo" class="input-100" required/><br/>
    
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
                <input type="checkbox" name='permissoes[]' value="<?php echo $listaPermissoes[$i+0]["id"];?>" id="p_<?php echo $listaPermissoes[$i+0]["id"];?>" />
                <label for="p_<?php echo $listaPermissoes[$i+0]["id"];?>"><?php echo $listaPermissoes[$i+0]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='permissoes[]' value="<?php echo $listaPermissoes[$i+1]["id"];?>" id="p_<?php echo $listaPermissoes[$i+1]["id"];?>" />
                <label for="p_<?php echo $listaPermissoes[$i+1]["id"];?>"><?php echo $listaPermissoes[$i+1]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='permissoes[]' value="<?php echo $listaPermissoes[$i+2]["id"];?>" id="p_<?php echo $listaPermissoes[$i+2]["id"];?>" />
                <label for="p_<?php echo $listaPermissoes[$i+2]["id"];?>"><?php echo $listaPermissoes[$i+2]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='permissoes[]' value="<?php echo $listaPermissoes[$i+3]["id"];?>" id="p_<?php echo $listaPermissoes[$i+3]["id"];?>" />
                <label for="p_<?php echo $listaPermissoes[$i+3]["id"];?>"><?php echo $listaPermissoes[$i+3]["nome"];?></label><br/>
            </td>
        </tr>  
        <?php endfor;?>
        <tr>
            <td>
                <input type="checkbox" name='permissoes[]' value="<?php echo $listaPermissoes[count($listaPermissoes)-2]["id"];?>" id="p_<?php echo $listaPermissoes[count($listaPermissoes)-2]["id"];?>" />
                <label for="p_<?php echo $listaPermissoes[count($listaPermissoes)-2]["id"];?>"><?php echo $listaPermissoes[count($listaPermissoes)-2]["nome"];?></label><br/>
            </td>
            <td>
                <input type="checkbox" name='permissoes[]' value="<?php echo $listaPermissoes[count($listaPermissoes)-1]["id"];?>" id="p_<?php echo $listaPermissoes[count($listaPermissoes)-1]["id"];?>" />
                <label for="p_<?php echo $listaPermissoes[count($listaPermissoes)-1]["id"];?>"><?php echo $listaPermissoes[count($listaPermissoes)-1]["nome"];?></label><br/>
            </td>

        </tr>

    </table><br/>
          
    <input type="submit" value="Adicionar" class="botao_pm" onclick="return confirm('Tem certeza?')"/>
   
</form>