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
        <div class="col-lg">
            <h1 class="display-4 text-capitalize text-nowrap"><?php echo isset($headerData) && !is_null($headerData["titulo"]) ? $headerData["titulo"] : $modulo ?></h1>
        </div>
        <div class="col-lg">
            <div class="input-group mb-3 mb-lg-0">
                <input type="search" name="searchDataTable" id="searchDataTable" aria-label="Pesquise por qualquer campo..." class="form-control" placeholder="Pesquise por qualquer campo..." aria-describedby="search-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <?php if(in_array(isset($headerData) && array_key_exists("adicionar", $headerData) && !is_null($headerData["adicionar"]["permissao"]) ? $headerData["adicionar"]["permissao"] : $modulo . "_add", $infoFunc["permissoesFuncionario"])):?>
                <a href="<?php echo BASE_URL . "/" . (isset($headerData["adicionar"]) ? $headerData["adicionar"]["url"] : $modulo . "/adicionar") ?>" class="btn btn-success btn-block">Adicionar</a>
            <?php endif ?>
        </div>
    </div>
</header>