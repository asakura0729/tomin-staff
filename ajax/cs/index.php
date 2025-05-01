<?php
//======================================================================
// ページ：対応ログ一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>

<?php appFuncCrmStorage::start(); ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="p-3">
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appFuncCrmArray::list(),
        'dbResult' => [
            'post_by' => appFuncString::boolString(appFuncSession::checkAuth(appConfigUser::authorityManager), '',  $_SESSION[appConfigSession::userId]),
            'cs_category' => appConfigStatus::csCategoryLog,
        ]
    ]); ?>
</article>
<?php appFuncCrmStorage::end(); ?>