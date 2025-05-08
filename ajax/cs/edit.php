<?php
//======================================================================
// ページ：対応ログ　作成／編集
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs/edit.php'; ?>

<?php appFuncCrmStorage::start(); ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>

<section class="p-3 pb-5">
    <div id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsEdit); ?>" class="minh-200px">
        <?php appFuncModule::include('../_module/form-edit.php', [
            'dbResult' => appHttpAjaxCsEdit::$dbResult,
            'postPrimaryKey' => ''
        ]); ?>
    </div>
    <?php appFuncModule::form('form-control', 0, ['inputName' => 'scroll', 'inputType' => 'hidden']); ?>
</section>
<section class="p-3 bg-base border-top border-bottom" data-layout-wide>
    <div class="pos-sticky">
        <?php appFuncModule::heading('h2', 'h2', '対応ログ検索'); ?>
    </div>
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appFuncCrmArray::list(),
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
            'client_tel' => appHttpAjaxCsEdit::$dbResult['client_tel']
        ]
    ]); ?>
</section>

<?php if (appHttpAjaxCsEdit::$dbResult['client_tel'] != ''): ?>
    <?php /*分岐：電話番号指定あり*/ ?>
    <?php appFuncModule::js('pageload-submit', ['target' => '[data-submit-search]']); ?>
<?php endif; ?>
<?php appFuncModule::js('form-scroll', ['target' => appConfigSite::secCsEdit]); ?>
<?php appFuncModule::js('link-confirm'); ?>
<?php appFuncCrmStorage::end(); ?>