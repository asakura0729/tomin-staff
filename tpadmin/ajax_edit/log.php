<?php require_once '../../_app/http/tpadmin/ajax_edit/log.php'; ?>
<?php require_once './_module/detail_css.php'; ?>

<div class="alert alert-danger text-center" role="alert">
    過去のデータを表示しています。登録・変更は行えません。
</div>
<?php echo appHttpTpAdminCrmAjaxLog::$result[0]['log']; ?>
<style>
    .l-submit-inner {
        display: none;
    }
</style>