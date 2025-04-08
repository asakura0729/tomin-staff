<?php
//======================================================================
// ページ：送客シート編集
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../../_app/http/tpadmin/cs_sheet/ajax/edit.php'; ?>
<?php require_once '../../_tmpl/ajax.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>

<form data-hx-post="<?php echo appRoutesWeb::sitemap['adminCsSeetEdit']['contents']; ?>" data-hx-target="<?php echo appConfigPage::pageMain; ?>" class="animation-fadein container pb-5">
    <div class="p-4 bg-white animation-fadein">
        <?php appFuncModule::localModule('../_module/print', [
            'formConfig' => [
                'moduleName' => 'form-control',
                'dbClass' => 'appDatabaseCs',
                'dbResult' => appHttpTpadminCssheetAjaxEdit::$dbResult,
                'editFlg' => true
            ]
        ]); ?>

    </div>
    <div class="pt-5 pb-5 w-300px mx-auto">
        <?php appFuncModule::btn('submit'); ?>
    </div>
</form>

<?php appFuncModule::js('form-submit'); ?>
<?php if (appHttpTpadminCssheetAjaxEdit::$postPrimaryKey != ''): ?>
    <?php /*分岐：データ更新*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('redirect', ['path' => appRoutesWeb::sitemap['adminCsSeetDetail']['contents'] . appFuncPath::setGetParam(['cs_id'], [appHttpTpadminCssheetAjaxEdit::$postPrimaryKey])]); ?>
    <?php appFuncModule::js('url-push', ['path' => appRoutesWeb::sitemap['adminCsSeetDetail']['path'] . appFuncPath::setGetParam(['cs_id'], [appHttpTpadminCssheetAjaxEdit::$postPrimaryKey])]); ?>
<?php endif; ?>