<?php
//======================================================================
// ページ：対応ログ一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php appFuncCrmStorage::start(); ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="p-3">
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appFuncCrmArray::list(),
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
        ]
    ]); ?>
</article>
<?php appFuncMinify::minifySourceEnd(); ?>
<?php appFuncModule::include('../_module/js-form-search.php'); ?>
<?php appFuncCrmStorage::end(); ?>