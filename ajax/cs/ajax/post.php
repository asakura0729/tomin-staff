<?php
//======================================================================
// 部品：対応ログ　入力フォーム
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../../_app/http/ajax/cs/ajax/post.php'; ?>
<?php appFuncModule::include('../../_module/form-edit.php', [
    'dbResult' => appHttpAjaxCsAjaxPost::$dbResult,
    'postPrimaryKey' => appHttpAjaxCsAjaxPost::$postPrimaryKey
]); ?>
<?php appFuncModule::js('totop'); ?>