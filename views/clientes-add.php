<script type="text/javascript">
    var baselink = '<?php echo BASE_URL;?>',
        currentModule = '<?php echo str_replace(array("-add", "-edt"), "", basename(__FILE__, ".php")) ?>'
</script>
<script src="<?php echo BASE_URL;?>/assets/js/clientes.js" type="text/javascript"></script>
<header class="d-flex align-items-center my-5">
    <?php if(in_array("clientes_ver", $infoFunc["permissoesFuncionario"])): ?>
        <a href="<?php echo BASE_URL . '/clientes' ?>" class="btn btn-secondary mr-4" title="Voltar">
            <i class="fas fa-chevron-left"></i>
        </a>
    <?php endif ?>
    <h1 class="display-4 m-0">Adicionar Cliente</h1>
</header>
<section class="mb-5">
    <form method="POST">
        <div class="row">
            <?php foreach ($colunas as $key => $value): ?>
                <?php if($value["Comment"]["add"] != "false"): ?>
                    <div class="col-<?php echo isset($value["Comment"]["column"]) ? $value["Comment"]["column"] : "12" ?>">
                        <?php if($value["Comment"]["type"] == "relacional"):?>
                            <div class="form-group">
                                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $value['nomecol']));?></label>
                                <select id="<?php echo 'itxt'.($i);?>" 
                                        name="<?php echo lcfirst($value['nomecol']);?>"
                                        class="form-control"
                                        <?php if($value['nulo'] == "NO"):?>
                                            required                  
                                        <?php endif;?> 
                                        >
                                        
                                        <option value="" selected >Selecione</option>
                                    <?php for($j = 0; $j < count($value['relacional']); $j++):?>
                                        <option value="<?php echo $value['relacional'][$j]['nome'];?>" ><?php echo $value['relacional'][$j]['nome'];?></option>
                                    <?php endfor;?>     
                                </select>
                            </div>
                        <?php elseif($value["Comment"]["type"] == "textarea"):?>
                            <div class="form-group">
                                <label for="<?php echo 'itxt'.($i);?>"><?php echo ucwords(str_replace("_", " ", $value['Field']));?></label>
                                <textarea
                                    class="form-control"
                                    name="<?php echo lcfirst($value['nomecol']);?>" 
                                    id="<?php echo 'itxt'.($i);?>"
                                    <?php if($value['nulo'] == "NO"):?>
                                        required                  
                                    <?php endif;?>
                                >
                                </textarea>
                            </div>
                        <?php elseif($value["Comment"]["type"] == "longtext"):?>
                            <div class="form_linha">
                                <div class="form_itemLinha">
                                    <input
                                        type="hidden"  
                                        name="<?php echo lcfirst($value['nomecol']);?>" 
                                        id="<?php echo 'itxt'.($i);?>"
                                        value=''                         
                                    />
                                </div>                
                            </div>
                        <?php elseif($value["Comment"]["type"] == "radio"): ?>
                            <div class="form-group">
                                <label><?php echo $value["Comment"]["label"] ?></label>
                                <div>
                                    <?php $indexRadio = 0 ?>
                                    <?php foreach ($value["Comment"]["options"] as $valueRadio => $label): ?>
                                        <?php $checkedRadio =  $indexRadio == 0 ? "checked" : "" ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="<?php echo $valueRadio ?>" value="<?php echo $valueRadio ?>" name="<?php echo $value["Field"] ?>" class="custom-control-input" <?php echo $checkedRadio ?>>
                                            <label class="custom-control-label" for="<?php echo $valueRadio ?>"><?php echo $label ?></label>
                                        </div>
                                        <?php $indexRadio++ ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php else:?>
                            <div class="form-group">
                                <label for="<?php echo 'itxt'.($i);?>"><?php echo !is_null($value["Comment"]["label"]) ? $value["Comment"]["label"] : ucwords(str_replace("_", " ", $value['Field'])) ?></label>
                                <input type="text" class="form-control" name="<?php echo lcfirst($value['Field']);?>" 
                                    id="<?php echo 'itxt'.($i);?>"
                                    <?php if($value['nulo'] == "NO"):?>
                                        required                  
                                    <?php endif;?> 
                                />
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="table-responsive">
            <h3 class="mt-5 mb-4">Contatos</h3>
            <table id="contatos" class="table table-striped table-hover bg-white mb-5">
                <thead>
                    <tr>
                        <th class="border-bottom-0">Nome</th>
                        <th class="border-bottom-0">Setor</th>
                        <th class="border-bottom-0">Celular</th>
                        <th class="border-bottom-0">Email</th>
                        <th class="border-bottom-0">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="contato_name">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="contato_setor">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="contato_celular">
                        </td>
                        <td>
                            <input type="email" class="form-control" name="contato_email">
                        </td>
                        <td>
                            <a href="javascript:void(0)" id="incluir" class="btn btn-primary">Incluir</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
            </div>
        </div>
    </form>
</section>