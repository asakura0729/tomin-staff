<?php
//======================================================================
// ページ：送客シート一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php appFuncStorage::start(); ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="p-3">
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appFuncCrmArray::sheetList(),
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
            'sheet_cs_category' => appConfigStatus::csCategorySheet,
            'sheet_approval_status' => appConfigStatus::approval_status['progress']['key'],
        ]
    ]); ?>
</article>
<?php appFuncMinify::minifySourceEnd(); ?>
<?php appFuncModule::include('../_module/js-form-search.php'); ?>
<?php appFuncStorage::end(); ?>