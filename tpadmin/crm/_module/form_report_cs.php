<div id="sec4-report_cs" class="border-top border-bottom">
    <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#sec-4-collapse-1', 'title' => '登録／編集']); ?>
    <div id="sec-4-collapse-1" class="collapse" data-disabled>
        <div class="p-3 pb-4">
            <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, [], ['value' => appDatabaseReport::categoryCs,]); ?>
            <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, [], ['value' => '対応ログ']); ?>
            <?php appLibraryDisp::dbform('hidden', ['comment'], appDatabaseReport::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs, ['add' => 'id="sec-4-comment"',]); ?>
            <?php appLibraryDisp::dbform('select_label', ['cs_category'], appDatabaseReport::tableCs, [], ['add' => 'data-disabled-toggle="#sec-4"', 'selectItem' => appDatabaseReport::csCategory]); ?>
            <?php appLibraryDisp::dbform('editor', ['comment'], appDatabaseReport::table, [], ['targetForm' => '#sec-4-comment']); ?>
            <?php appLibraryDisp::dbform('hidden', ['log'], appDatabaseReport::tableCs, [], ['add' => 'data-report-log']); ?>
            <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmReport); ?>
        </div>
    </div>
</div>
<div id="sec4-container_report_cs" class="border-top border-bottom" <?php if (appFuncSession::checkAuth(appConfigUser::manager) === false): ?>data-disabled<?php endif; ?>>
    <?php appLibraryDisp::globalModule('btn/collapse_xl', ['target' => '#sec-4-collapse-2', 'title' => '承認者確認']); ?>
    <div id="sec-4-collapse-2" class="collapse">
        <div class="p-3 pb-4">
            <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs, ['add' => 'data-funeral_id',]); ?>
            <?php appLibraryDisp::dbform('hidden', [appDatabaseContainerCs::primaryKey], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs); ?>
            <?php if (appHttpTpAdminCrmAjaxDetail::$resultReportCs[appDatabaseContainerCs::primaryKey] === ''): ?>
                <?php
                //-----------------------------------------------------
                // 分岐：新規
                //-----------------------------------------------------
                ?>
                <p class="p-3 text-center">承認者のコメントはありません</p>
                <?php appLibraryDisp::dbform('hidden', ['approval_status'], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs); ?>
            <?php elseif (appFuncSession::checkAuth(appConfigUser::manager) === false): ?>
                <?php
                //-----------------------------------------------------
                // 分岐2：既存（権限なし）
                //-----------------------------------------------------
                ?>
                <?php appLibraryDisp::dbform('string', ['approval_comment'], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs, ['targetForm' => '#sec-4-approval_comment']); ?>
            <?php else: ?>
                <?php
                //-----------------------------------------------------
                // 分岐3：既存（権限あり）
                //-----------------------------------------------------
                ?>
                <?php appLibraryDisp::dbform('radio_row', ['approval_status'], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs, ['selectItem' => appDatabaseContainerCs::status]); ?>
                <?php appLibraryDisp::dbform('editor', ['approval_comment'], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs, ['targetForm' => '#sec-4-approval_comment']); ?>
                <?php appLibraryDisp::dbform('hidden', ['approval_comment'], appDatabaseContainerCs::table, appHttpTpAdminCrmAjaxDetail::$resultReportCs, ['add' => 'id="sec-4-approval_comment"',]); ?>
            <?php endif; ?>
            <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmContainerCs); ?>
        </div>
    </div>
</div>