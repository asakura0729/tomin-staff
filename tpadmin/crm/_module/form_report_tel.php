<div class="pb-2">
    <div class="p-3 bg-white">
        <?php appLibraryDisp::dbform('datetime_label',  ['tel_date'], appDatabaseReport::tableTel, $option['result']); ?>
        <?php appLibraryDisp::dbform('text_label',  ['comment'], appDatabaseReport::table, $option['result']); ?>
    </div>
</div>