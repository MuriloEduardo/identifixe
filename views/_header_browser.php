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
        <div class="col flex-grow-0">
            <h1 class="display-4"><?php echo $headerData["titulo"] ?></h1>
        </div>
        <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="search" name="searchDataTable" id="searchDataTable" aria-label="Pesquise por qualquer campo..." class="form-control" placeholder="Pesquise por qualquer campo..." aria-describedby="search-addon">
            </div>
        </div>
        <div class="col flex-grow-0">
            <?php if(in_array($headerData["adicionar"]["permissao"], $infoFunc["permissoesFuncionario"])):?>
                <a href="<?php echo BASE_URL . $headerData["adicionar"]["url"] ?>" class="btn btn-success px-5">Adicionar</a>
            <?php endif ?>
        </div>
    </div>
</header>