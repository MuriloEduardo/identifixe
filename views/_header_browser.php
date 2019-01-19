<?php if(!empty($aviso)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <?php echo $aviso ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>
<header class="pt-4 pb-5">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="display-4 text-capitalize text-nowrap"><?php echo !is_null($headerData["titulo"]) ? $headerData["titulo"] : $modulo ?></h1>
        </div>
        <div class="col">
            <div class="input-group">
            <input type="search" name="searchDataTable" id="searchDataTable" aria-label="Pesquise por qualquer campo..." class="form-control" placeholder="Pesquise por qualquer campo..." aria-describedby="search-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <?php if(in_array(!is_null($headerData["adicionar"]["permissao"]) ? $headerData["adicionar"]["permissao"] : $modulo . "_add", $infoFunc["permissoesFuncionario"])):?>
                <a href="<?php echo BASE_URL . "/" . (!is_null($headerData["adicionar"]["url"]) ? $headerData["adicionar"]["url"] : $modulo . "/adicionar") ?>" class="btn btn-success btn-block">Adicionar</a>
            <?php endif ?>
        </div>
    </div>
</header>