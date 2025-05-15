<?php
//======================================================================
//対応ログ編集フォーム専用JS
//$option['dbResult']...DBから取得したデータ
//======================================================================
?>

<?php if ($option['dbResult'][appDatabaseCs::primaryKey] === ''): ?>
    <?php /*分岐：データが新規*/ ?>
    <?php appFuncModule::js('form-user_id', ['target' => appConfigSite::secCsEdit, 'child' => 'select[name=post_by]']); ?>
<?php endif; ?>

<?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) === false): ?>
    <?php /*分岐1：権限／スタッフ*/ ?>
    <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secCsEdit, 'child' => 'select[name=post_by]']); ?>
    <?php if (
        $option['dbResult']['cs_id'] != '' && $option['dbResult']['approval_status'] === appConfigStatus::approval_status['complete']['key'] ||
        $option['dbResult']['cs_id'] != '' && $option['dbResult']['post_by'] != $_SESSION[appConfigSession::userId]
    ): ?>
        <?php /*分岐1-1：権限／スタッフ＞対応ログが承認済み*/ ?>
        <?php /*分岐1-2：権限／スタッフ＞他のユーザーが作成*/ ?>
        <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secCsEdit]); ?>
    <?php else: ?>
        <?php /*分岐1-3：権限／スタッフ＞他 */ ?>
        <?php appFuncModule::js('form-submit'); ?>
        <?php appFuncModule::js('form-submit-redirect'); ?>
    <?php endif; ?>
<?php else: ?>
    <?php /*分岐2：権限／管理者*/ ?>
    <?php appFuncModule::js('form-submit'); ?>
    <?php appFuncModule::js('form-submit-redirect'); ?>
<?php endif; ?>

<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secCsEdit]); ?>
<?php appFuncModule::js('message', ['target' => '[data-disp=approval_by]', 'msg' => appFuncDataformat::selectmenu(appDatabaseCs::table, 'approval_by', $option['dbResult']['approval_by'])]); ?>