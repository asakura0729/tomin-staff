<?php
//======================================================================
// 部品：対応ログ　入力フォーム（承認）
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../../_app/http/ajax/cs/ajax/post_approval.php'; ?>

<?php if (appHttpAjaxCsAjaxPost_approval::$postPrimaryKey != ''): ?>
    <?php /*分岐：データが更新された*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('pageload-submit', ['target' => '[data-submit-search]']); ?>
    <?php appFuncModule::js('hx-trigger-autoload'); ?>
<?php endif; ?>
