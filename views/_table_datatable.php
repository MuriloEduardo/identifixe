<div class="alert <?php echo $_SESSION["returnMessage"]["class"] ?>">
    <?php 
    if (isset($_SESSION["returnMessage"])) {
        echo $_SESSION["returnMessage"]["mensagem"];
        $_SESSION["returnMessage"]["show"] = true;
    }
    ?>
</div>
<table class="table table-striped table-hover dataTable bg-white table-nowrap first-column-fixed">
    <thead>
        <tr>
            <?php foreach ($colunas as $key => $value): ?> 
                <?php if(isset($value["Comment"]) && array_key_exists("ver", $value["Comment"]) && $value["Comment"]["ver"] != "false") : ?>
                    <th class="border-top-0">
                        <span><?php echo (isset($value["Comment"]["label"]) && !is_null($value["Comment"]["label"]) && !empty($value["Comment"]["label"])) ? $value["Comment"]["label"] : ucwords(str_replace("_", " ", $value['Field'])) ?></span>
                        <i class="small text-muted fas fa-sort ml-2"></i>
                    </th>
                <?php endif ?>
            <?php endforeach ?>
        </tr>
    </thead>
</table>