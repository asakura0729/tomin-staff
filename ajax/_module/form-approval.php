<?php
//======================================================================
//汎用モジュール：対応ログ編集フォーム
//$option['cs_id']...DBから取得したプライマリキー
//======================================================================
?>
<form data-hx-post="<?php echo appRoutesWeb::async['adminCsAjaxPost']['contents']; ?>" data-hx-target="#form-edit">
    <?php appFuncModule::form('form-control', "", ['inputName' => appDatabaseCs::table['cs_id']['name'], 'inputType' => 'hidden']); ?>
    <?php appFuncModule::form('form-control', appConfigStatus::approval_status['complete']['key'], ['inputName' => appDatabaseCs::table['approval_status']['name'], 'inputType' => 'hidden']); ?>
</form>

<?php if ($option['postPrimaryKey'] != ''): ?>
    <?php /*分岐2：データ更新*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
<?php endif; ?>
<?php appFuncModule::js('form-submit'); ?>