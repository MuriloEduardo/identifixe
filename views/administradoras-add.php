<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<h1 class="display-4">Adicionar Administradora</h1>


<form method="POST">
   
    <input type="text" name="nome" id="inome" placeholder="Nome da Administradora" class="form-control" required/><br/>

    <select id="iband" name="band"  class="select-100">
        <option value="" selected >Selecione a Bandeira</option>
        <?php foreach ($listaBandeiras as $p):?>
        <option value="<?php echo $p["id"];?>"><?php echo ucfirst($p["nome"]);?></option>
        <?php endforeach;?>
    </select>
    <input type="text" name="txdebito" id="itxdebito" placeholder="Taxa Recebimento Débito" class="input-100" />
    <input type="text" name="diasdebito" id="idiasdebito" placeholder="Dias Recebimento Débito" class="input-100" />
    <input type="text" name="txcredcom" id="itxcredcom" placeholder="Taxa Recebimento Crédito c/ Juros" class="input-100" />
    <input type="text" name="diascredcom" id="idiascredcom" placeholder="Dias Recebimento Crédito c/ Juros" class="input-100" />
    <input type="text" name="diasantecip" id="idiasantecip" placeholder="Dias Recebimento Antecipação" class="input-100" />
    <select id="inroparc" name="nroparc"  class="select-100" >
        <option value="">Número Máximo Parcelas</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select>
    <table class="table_add">
        <tr>
            <th>Tx. Antecipação</th>
            <th>Tx. Créd. Sem Juros</th>
        </tr>
        <?php for($i=1;$i<=12;$i++):?>
        <tr>
            <td><input type="text" id="itxantecip_<?php echo $i;?>" placeholder="Taxa Recebimento Antecipação <?php echo $i;?>X" class="input-table" required /></td>
            <td><input type="text"  id="itxcredsemjuros_<?php echo 12+$i;?>" placeholder="Taxa Recebimento Crédito sem Juros <?php echo $i;?>X" class="input-table" required /></td>
        </tr>
        <?php endfor;?>
    </table>
    <input type="button" value="Incluir" class="botao_admAux" onclick="confirmaPreenchimento()"/><br/><br/>
   
    <label class="label-100">Bandeiras Selecionadas:</label><br/>     
    <table class="table_add" id="tabelaenvio">
        <thead>
            <th>Bandeira</th>
            <th class="colTabela">Info Déb. e Créd. com Juros</th>
            <th class="colTabela">Info Tx. Antecip.</th>
            <th class="colTabela">Info Tx. Créd. sem Juros</th>
            <th>Ações</th>
        </thead>
        <tbody>

        </tbody>    
    </table>
        
    <input type="submit" value="Adicionar" class="botao_adm" onclick="testeEnvio()"/>
   
</form>