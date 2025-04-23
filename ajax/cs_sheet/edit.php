<?php
//======================================================================
// ページ：送客シート編集
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs_sheet/edit.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>

<form id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsEdit); ?>" data-hx-post="<?php echo appRoutesWeb::sitemap['adminCsSheetEdit']['contents']; ?>" data-hx-target="<?php echo appConfigSite::pageMain; ?>" class="container pb-5">
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
<?php if (appHttpCssheetAjaxEdit::$postPrimaryKey != ''): ?>
    <?php /*分岐：データ更新*/ ?>
    <?php appFuncModule::js('redirect', ['path' => appRoutesWeb::sitemap['adminCsSheetDetail']['contents'] . appFuncPath::setGetParam(['cs_id'], [appHttpCssheetAjaxEdit::$postPrimaryKey])]); ?>
    <?php appFuncModule::js('url-push', ['path' => appRoutesWeb::sitemap['adminCsSheetDetail']['path'] . appFuncPath::setGetParam(['cs_id'], [appHttpCssheetAjaxEdit::$postPrimaryKey])]); ?>
<?php endif; ?>