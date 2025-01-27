<div class="pb-1">
    <div class="p-1 bg-white">
        <div class="row no-gutters">
            <?php appLibraryDisp::dbform('text_row', [$option['inputName']], appDatabaseFuneral::table, $option['result'], ['multiple' => true]); ?>
            <div class="col-1 text-center"><?php appLibraryDisp::globalModule('form/btn_del', ['add' => '']); ?></div>
        </div>
    </div>
</div>