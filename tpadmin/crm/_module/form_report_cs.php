<div class="pb-2">
    <div class="p-3 bg-white">
        <?php appLibraryDisp::dbform('text_label',  ['title'], appDatabaseReport::table, $option['result'], ['title' => ['顧客名']]); ?>
        <div class="h-100px">
            <?php appLibraryDisp::dbform('textarea_simple',  ['comment'], appDatabaseReport::table, $option['result']); ?>
        </div>
    </div>
</div>