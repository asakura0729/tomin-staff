<?php
//======================================================================
// 部品：ログチェック
//======================================================================
?>
<?php require_once '../_app/ssl_base.php'; ?>
<?php require_once '../_app/http/ajax/count_approval.php'; ?>

<?php if (adminAjaxCount_approval::$dbResultCsCount != 0): ?>
    <span class="badge badge-pill badge-danger"><?php echo adminAjaxCount_approval::$dbResultCsCount; ?></span>
<?php endif; ?>