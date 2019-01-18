<table class="table table-striped table-hover dataTable">
    <thead>
        <tr>
            <th class="actions">Ações</th>
            <?php for($i = 1; $i< count($colunas)-2; $i++):?>
                <?php
                if(lcfirst($colunas[$i]['tipo']) == 'longtext') {
                    $attrLongtext = 'data-multidim="longtext"';
                } else {
                    $attrLongtext = '';
                }
                ?>
                <th <?php echo $attrLongtext ?>>
                    <span><?php echo ucwords(str_replace("_", " ", $colunas[$i]['nomecol'])) ?></span>
                    <i class="small text-muted fas fa-sort ml-2"></i>
                </th>
            <?php endfor;?>
        </tr>
    </thead>
</table>