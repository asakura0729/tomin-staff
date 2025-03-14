<div class="pb-2 animation-fadein">
    <div class="p-3 bg-white">
        <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, $option['result'], ['multiple' => true, 'add' => 'data-funeral_id']); ?>
        <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryTel, 'multiple' => true]); ?>
        <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryTel, 'multiple' => true]); ?>
        <?php appLibraryDisp::dbform('datetime_label',  ['tel_date'], appDatabaseReport::tableTel, $option['result'], ['multiple' => true]); ?>
        <?php appLibraryDisp::dbform('text_label',  ['comment'], appDatabaseReport::table, $option['result'], ['multiple' => true]); ?>
        <?php appLibraryDisp::dbform('select_label',  ['tel_status'], appDatabaseReport::tableTel, $option['result'], ['css' => 'pt-2', 'multiple' => true, 'selectItem' => appDatabaseReport::telStatus]); ?>
        <?php if (!isset($option['result']['report_id'])): ?>
            <?php appLibraryDisp::dbform('hidden', ['tel_by'], appDatabaseReport::tableTel, $option['result'], ['multiple' => true, 'value' => $_SESSION[appConfigSession::userId]]); ?>
        <?php endif; ?>
        <?php appLibraryDisp::dbform('hidden', ['report_id'], appDatabaseReport::table, $option['result'], ['multiple' => true]); ?>
    </div>
</div>
