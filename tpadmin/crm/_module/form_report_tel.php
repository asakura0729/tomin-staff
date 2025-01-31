<div class="pb-2 animation-fadein">
    <div class="p-3 bg-white">
        <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, [], ['multiple' => true, 'add' => 'data-primary']); ?>
        <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryTel, 'multiple' => true]); ?>
        <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryTel, 'multiple' => true]); ?>
        <?php appLibraryDisp::dbform('datetime_label',  ['tel_date'], appDatabaseReport::tableTel, $option['result'], ['multiple' => true]); ?>
        <?php appLibraryDisp::dbform('text_label',  ['comment'], appDatabaseReport::table, $option['result'], ['multiple' => true]); ?>
        <?php appLibraryDisp::dbform('hidden', ['report_id'], appDatabaseReport::table, $option['result'], ['multiple' => true]); ?>
        <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, $option['result'], ['multiple' => true]); ?>
    </div>
</div>