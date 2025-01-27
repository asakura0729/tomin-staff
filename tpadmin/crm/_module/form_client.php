<section class="pb-2 position-relative">
    <div class="bg-white">
        <header class="d-flex justify-content-between text-center bg-contrast-l border-bottom p-2">
            <h3 class="font-size-1_2 m-0 p-0">顧客</h3>
            <div class="pos-top-right p-2">
                <?php //appLibraryDisp::globalModule('form/btn_add', ['add' => '']); ?>
            </div>
        </header>
        <div class="p-3">
            <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名']); ?>
            <div class="form-row pb-2">
                <?php appLibraryDisp::dbform('text_row', ['fc_fname', 'fc_lname'], appDatabaseFuneralclient::table, $option['result'], ['multiple' => true]); ?>
            </div>
            <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名（カナ）']); ?>
            <div class="form-row pb-2">
                <?php appLibraryDisp::dbform('text_row', ['fc_fname_kana', 'fc_lname_kana'], appDatabaseFuneralclient::table, $option['result'], ['multiple' => true]); ?>
            </div>
            <?php appLibraryDisp::dbform('text_label', ['fc_tel'], appDatabaseFuneralclient::table, $option['result'], ['multiple' => true]); ?>
            <?php appLibraryDisp::dbform('select_label', ['fc_gender'], appDatabaseFuneralclient::table, $option['result'], ['multiple' => true, 'selectItem' => appConfigStatus::gender]); ?>
            <?php appLibraryDisp::dbform('text_label', ['fc_region'],  appDatabaseFuneralclient::table, $option['result'], ['multiple' => true]); ?>
        </div>
    </div>
</section>