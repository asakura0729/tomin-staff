<div class="p-3 bg-white">
    <div class="pb-3">
        <?php appLibraryDisp::heading('h2', '本日対応ログ', ['class' => 'text-center']); ?>
        <?php appLibraryDisp::globalModule(
            'btn/collapse_xl',
            [
                'target' => '#sec-4-collapse-1',
                'title' => '登録／編集'
            ]
        ); ?>
        <div id="sec-4-collapse-1" class="collapse">
            <div class="p-3">
                <?php appLibraryDisp::dbform('hidden', ['report_id'], appDatabaseReport::table, [], ['multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, [], ['value' => '対応ログ', 'multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryCs, 'multiple' => true]); ?>
                <?php appLibraryDisp::dbform('select_label', ['cs_category'], appDatabaseReport::tableCs, [], ['add' => 'data-disabled-toggle="#sec-4"', 'multiple' => true, 'selectItem' => appDatabaseReport::csCategory]); ?>
                <?php appLibraryDisp::dbform('hidden', ['comment'], appDatabaseReport::table, [], ['add' => 'id="sec-4-comment"', 'multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['add' => 'data-primary', 'multiple' => true]); ?>
                <div data-editor='#sec-4-comment'></div>
            </div>
        </div>
    </div>
    <div class="pb-3">
        <?php appLibraryDisp::heading('h2', '承認者確認', ['class' => 'text-center']); ?>
        <?php appLibraryDisp::globalModule(
            'btn/collapse_xl',
            [
                'target' => '#sec-4-collapse-2',
                'title' => '登録／編集'
            ]
        ); ?>
        <div id="sec-4-collapse-2" class="collapse">
            <div class="p-3">
                <?php appLibraryDisp::dbform('hidden', ['approval_status'], appDatabaseReport::tableCs, [], ['multiple' => true]); ?>
                <?php appLibraryDisp::dbform('hidden', ['approval_comment'], appDatabaseReport::tableCs, [], ['add' => 'id="sec-4-approval_comment"', 'multiple' => true]); ?>
                <div data-editor='#sec-4-approval_comment'></div>
            </div>
        </div>
    </div>
    <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmReport); ?>
</div>