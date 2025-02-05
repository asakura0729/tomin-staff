<?php require_once '../../../_app/http/tpadmin/crm/ajax/log.php'; ?>
<?php require_once '../_module/detail_css.php'; ?>

<div class="alert alert-danger" role="alert">
    これは過去の記録です
</div>
<?php echo appHttpTpAdminCrmAjaxLog::$result[0]['log']; ?>