<?php $modulo = str_replace("-form", "", basename(__FILE__, ".php")) ?>
<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo $modulo ?>'
</script>
<header class="d-flex align-items-center my-5">
    <?php if(in_array($modulo . "_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/' . $modulo ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0"><?php echo $viewInfo["title"] ?> Produto</h1>
</header>
<section class="mb-5">
    <form method="POST">
        <div class="row">
            <?php foreach ($colunas as $key => $value): ?>
                <?php if($value["Comment"]["form"] != "false"): ?>
                    <div class="col-<?php echo isset($value["Comment"]["column"]) ? $value["Comment"]["column"] : "12" ?>">
                        <div class="form-group">
                            <label class="<?php echo $value["Null"] == "NO" ? "font-weight-bold" : "" ?>" for="<?php echo $value['Field'] ?>"><?php echo !is_null($value["Comment"]["label"]) ? $value["Comment"]["label"] : ucwords(str_replace("_", " ", $value['Field'])) ?></label>
                            <?php if($value["Comment"]["type"] == "relacional"): ?>
                                <!-- Tipo: Relacional -->
                                <select id="<?php echo 'itxt'.($i);?>" 
                                        name="<?php echo lcfirst($value['nomecol']);?>"
                                        class="form-control"
                                        <?php echo $value['Null'] == "NO" ? "required" : "" ?>
                                        >
                                        <option value="" selected >Selecione</option>
                                    <?php for($j = 0; $j < count($value['relacional']); $j++):?>
                                        <option value="<?php echo $value['relacional'][$j]['nome'];?>" ><?php echo $value['relacional'][$j]['nome'];?></option>
                                    <?php endfor;?>     
                                </select>
                            <?php elseif($value["Comment"]["type"] == "textarea"): ?>
                                <textarea
                                    class="form-control" 
                                    name="<?php echo lcfirst($value['Field']);?>" 
                                    value="<?php echo isset($dados) ? $dados[$value["Field"]] : "" ?>"
                                    id="<?php echo $value['Field'] ?>"
                                    <?php echo $value['Null'] == "NO" ? "required" : "" ?>
                                ></textarea>
                            <?php elseif($value["Comment"]["type"] == "radio"): ?>
                                <div>
                                    <?php $indexRadio = 0 ?>
                                    <?php foreach ($value["Comment"]["options"] as $valueRadio => $label): ?>
                                        <?php $checkedRadio =  $indexRadio == 0 ? "checked" : "" ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input 
                                                type="radio" 
                                                id="<?php echo $valueRadio ?>" 
                                                value="<?php echo $valueRadio ?>" 
                                                name="<?php echo $value["Field"] ?>" 
                                                class="custom-control-input" 
                                                <?php echo $checkedRadio ?>
                                                <?php echo $value['Null'] == "NO" ? "required" : "" ?>
                                            >
                                            <label class="custom-control-label" for="<?php echo $valueRadio ?>"><?php echo $label ?></label>
                                        </div>
                                        <?php $indexRadio++ ?>
                                    <?php endforeach ?>
                                </div>
                            <?php else: ?>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="<?php echo $value['Field'] ?>" 
                                    value="<?php echo isset($dados) ? $dados[$value["Field"]] : "" ?>"
                                    id="<?php echo $value['Field'] ?>"
                                    <?php echo $value['Null'] == "NO" ? "required" : "" ?>
                                />
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <button type="submit" id="main-form" class="d-none"></button>
    </form>
    <div class="row">
        <div class="col-lg-2">
            <label for="main-form" class="btn btn-primary btn-block" tabindex="0">Salvar</label>
        </div>
    </div>
</section>