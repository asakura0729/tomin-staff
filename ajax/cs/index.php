<?php
//======================================================================
// ページ：対応ログ一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../_tmpl/ajax.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="p-3">
    <?php appFuncModule::localModule('../_module/form-search', [
        'path' => appConfigPage::$path,
        'dbTable' => appDatabaseCs::form,
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
        ]
    ]); ?>
</article>
<?php appFuncModule::js('form-cs', ['target' => '#form-search']); ?>
<?php appFuncModule::js('pageload-submit-search', ['target' => '#form-search']); ?>