<?php
//======================================================================
// 部品：対応ログ　入力フォーム
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/tpadmin/ajax/cs-edit.php'; ?>
<?php appFuncModule::localModule('../_module/form-edit', [
    'dbResult' => appHttpAjaxCsedit::$dbResult,
    'postPrimaryKey' => appHttpAjaxCsedit::$postPrimaryKey
]); ?>