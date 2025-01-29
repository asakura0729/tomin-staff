<?php require_once '../../../_app/http/tpadmin/crm/ajax/report_cs.php'; ?>

<div class="p-3 bg-white">
    <?php appLibraryDisp::heading('h2', '本日対応ログ', ['class' => 'text-center']); ?>
    <?php appLibraryDisp::dbform('hidden', ['report_id'], appDatabaseReport::table, appHttpTpAdminCrmAjaxReportcs::$result[0], ['multiple' => true]); ?>
    <?php appLibraryDisp::dbform('hidden', ['title'], appDatabaseReport::table, appHttpTpAdminCrmAjaxReportcs::$result[0], ['value' => '対応ログ', 'multiple' => true]); ?>
    <?php appLibraryDisp::dbform('hidden', ['report_category'], appDatabaseReport::table, appHttpTpAdminCrmAjaxReportcs::$result[0], ['value' => appDatabaseReport::categoryCs, 'multiple' => true]); ?>
    <?php appLibraryDisp::dbform('select_label', ['cs_category'], appDatabaseReport::tableCs, appHttpTpAdminCrmAjaxReportcs::$result[0], ['multiple' => true, 'add' => 'data-cs_category="#sec-4"', 'selectItem' => appDatabaseReport::csCategory]); ?>
    <?php appLibraryDisp::dbform('hidden', ['comment'], appDatabaseReport::table, appHttpTpAdminCrmAjaxReportcs::$result[0], ['add' => 'id="sec-4-comment"', 'multiple' => true]); ?>
    <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseReport::tableCs, appHttpTpAdminCrmAjaxReportcs::$result[0], ['add' => 'data-primary', 'multiple' => true]); ?>
    <?php appLibraryDisp::form('hidden', appLibraryCrm::postConfirm, 'データの種類', appLibraryCrm::confirmReport); ?>
    <div data-editor='#sec-4-comment'>
        <?php echo appHttpTpAdminCrmAjaxReportcs::$result[0]['comment']; ?>
    </div>
</div>