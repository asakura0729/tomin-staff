<?php
//======================================================================
// ページ：送客シート編集
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs_sheet/edit.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>

<?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) != true): ?>
    <?php /*分岐：スタッフ権限*/ ?>
    <?php if (appHttpCssheetAjaxEdit::$dbResult['approval_status'] === appConfigStatus::approval_status['complete']['key']): ?>
        <?php /*分岐：スタッフ権限＞承認完了*/ ?>
        <p class="text-center"><?php appFuncModule::string('exclamation', '承認済みの送客シートは編集できません'); ?>
    <?php endif; ?>
<?php endif; ?>

<form id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsEdit); ?>" data-hx-post="<?php echo appRoutesWeb::sitemap['adminCsSheetDetail']['contents']; ?>" data-hx-target="<?php echo appConfigSite::pageMain; ?>" class="container pb-5">
    <div class="p-4 bg-white">
        <?php appFuncModule::include('../_module/print-sheet.php', [
            'moduleName' => 'form-control',
            'dbTable' => appDatabaseCs::table,
            'dbResult' => appHttpCssheetAjaxEdit::$dbResult,
            'editFlg' => true
        ]); ?>
    </div>
    <div class="pt-5 pb-5 w-300px mx-auto">
        <?php appFuncModule::btn('submit', ['title' => 'プレビュー']); ?>
    </div>
</form>

<?php appFuncModule::js('form-submit'); ?>
<?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secCsEdit, 'child' => 'textarea[name=option_flower]']); ?>
<?php appFuncModule::js('form-sheet', ['target' => appConfigSite::secCsEdit]); ?>
<?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) != true): ?>
    <?php /*分岐：スタッフ権限*/ ?>
    <?php if (appHttpCssheetAjaxEdit::$dbResult['approval_status'] === appConfigStatus::approval_status['complete']['key']): ?>
        <?php /*分岐：スタッフ権限＞承認完了*/ ?>
        <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secCsEdit]); ?>
    <?php endif; ?>
<?php endif; ?>