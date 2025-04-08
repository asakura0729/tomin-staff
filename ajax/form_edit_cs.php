<?php
//======================================================================
// 部品：対応ログ　入力フォーム
//======================================================================
?>
<?php require_once '../_app/ssl_base.php'; ?>
<?php require_once '../_app/http/ajax/form_edit_cs.php'; ?>

<p class="text-danger">※既存の対応ログを転記しました。「登録」を押すと、対応ログが新しく追加されます。</p>
<?php appFuncModule::localModule('./_module/form-edit', [
    'dbResult' => appHttpForm_edit_cs::$dbResult,
    'postPrimaryKey' => appHttpForm_edit_cs::$postPrimaryKey
]); ?>
<?php appFuncModule::js('totop'); ?>