<?php require_once '../../_app/http/tpadmin/crm/confirm.php'; ?>

<?php if (appHttpTpAdminCrmConfirm::$postConfirm === appLibraryCrm::confirmFuneralId): ?>
    <?php /*分岐：葬儀IDの取得*/ ?>
    <?php appLibraryDisp::dbform('hidden', [appDatabaseFuneral::primaryKey], appDatabaseFuneral::table, appHttpTpAdminCrmConfirm::$result); ?>
<?php endif; ?>