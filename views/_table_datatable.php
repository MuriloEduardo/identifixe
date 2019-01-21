<table class="table table-striped table-hover dataTable bg-white">
    <thead>
        <tr>
            <?php foreach ($colunas as $key => $value): ?> 
                <?php if($value["Comment"]["ver"] != "false") : ?>
                    <th class="border-top-0">
                        <span><?php echo isset($value["Comment"]["label"]) && !is_null($value["Comment"]["label"]) ? $value["Comment"]["label"] : ucwords(str_replace("_", " ", $value['Field'])) ?></span>
                        <i class="small text-muted fas fa-sort ml-2"></i>
                    </th>
                <?php endif ?>
            <?php endforeach ?>
        </tr>
    </thead>
</table>