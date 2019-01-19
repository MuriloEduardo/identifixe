<link href="<?php echo BASE_URL;?>/assets/css/administradoras.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo BASE_URL;?>/assets/js/administradoras.js" type="text/javascript"></script>

<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>

<header class="d-flex align-items-center my-5">
    <?php if(in_array("administradoras_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/administradoras' ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0">Adicionar Administradora</h1>
</header>

<form method="POST">
    <div class="form-group">
        <label for="inome">Nome da Administradora</label>
        <input type="text" name="nome" id="inome" class="form-control" autofocus required/>
    </div>
    <div class="form-group">
        <label for="iband">Bandeira</label>
        <select id="iband" name="band" class="form-control">
            <option value="" selected >Selecione</option>
            <?php foreach ($listaBandeiras as $p):?>
            <option value="<?php echo $p["id"];?>"><?php echo ucfirst($p["nome"]);?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="itxdebito">Taxa de Recebimento no Débito</label>
                <input type="text" name="txdebito" id="itxdebito" class="form-control" />
            </div>
        </div>
        <div class="col">
            <label for="idiasdebito">Dias de Recebimento no Débito</label>
            <input type="text" name="diasdebito" id="idiasdebito" class="form-control" />
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="itxcredcom">Taxa Recebimento Crédito c/ Juros</label>
                <input type="text" name="txcredcom" id="itxcredcom" class="form-control" />
            </div>
        </div>
        <div class="col">
            <label for="idiascredcom">Dias Recebimento Crédito c/ Juros</label>
            <input type="text" name="diascredcom" id="idiascredcom" class="form-control" />
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-group">
                <label for="idiasantecip">Dias Recebimento Antecipação</label>
                <input type="text" name="diasantecip" id="idiasantecip" class="form-control" />
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="inroparc">Número Máximo Parcelas</label>
                <select id="inroparc" name="nroparc"  class="form-control">
                    <option value="" selected >Selecione</option>
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
            </div>
        </div>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Tx. Antecipação</th>
                <th>Tx. Créd. Sem Juros</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=1;$i<=12;$i++):?>
            <tr>
                <td>
                    <input type="text" id="itxantecip_<?php echo $i;?>" placeholder="Taxa Recebimento Antecipação <?php echo $i;?>X" class="form-control" required />
                </td>
                <td>
                    <input type="text" id="itxcredsemjuros_<?php echo 12+$i;?>" placeholder="Taxa Recebimento Crédito sem Juros <?php echo $i;?>X" class="form-control" required />
                </td>
            </tr>
        <?php endfor;?>
        </tbody>
    </table>
    <input type="button" value="Incluir" class="btn btn-primary" onclick="confirmaPreenchimento()"/><br/><br/>
   
    <h4 class="pb-4 pt-5">Bandeiras Selecionadas</h4>
    <table class="table table-striped table-hover">
        <thead>
            <th>Ações</th>
            <th>Bandeira</th>
            <th class="colTabela">Info Déb. e Créd. com Juros</th>
            <th class="colTabela">Info Tx. Antecip.</th>
            <th class="colTabela">Info Tx. Créd. sem Juros</th>
        </thead>
        <tbody></tbody>
    </table>
        
    <input type="submit" value="Adicionar" class="btn btn-success" onclick="testeEnvio()"/>
   
</form>