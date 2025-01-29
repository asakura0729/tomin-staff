<section class="pb-2 position-relative animation-fadein" data-form-elem>
    <div class="bg-white">
        <header class="border">
            <?php if (isset($option['index'])): ?>
                <?php appLibraryDisp::globalModule(
                    'btn/collapse_xl',
                    [
                        'target' => '#sec2-fc_' . $option['index'],
                        'title' => '顧客【' . appFuncCalc::foreachCount($option['index']) . '】'
                    ]
                ); ?>
            <?php else: ?>
                <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '', 'title' => '顧客']); ?>
            <?php endif; ?>
        </header>
        <div <?php if (isset($option['index'])): ?>id="sec2-fc_<?php echo $option['index']; ?>" class="p-3 collapse" <?php else: ?> class="p-3" <?php endif; ?>>
            <div class="pb-3">□資料送付チェックボックス（未実装）</div>
            <?php appLibraryDisp::dbform('hidden', [appDatabaseFuneralclient::primaryKey], appDatabaseFuneralclient::table, $option['result'], ['multiple' => true]); ?>
            <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneralclient::table, $option['result'], ['multiple' => true, 'add' => 'data-primary']); ?>
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