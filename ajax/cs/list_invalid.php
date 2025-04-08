<?php
//======================================================================
// ページ：対応ログ（無効電話一覧）
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../_tmpl/ajax.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="animation-fadein p-3">
    <?php appFuncModule::localModule('../../_module/form-search', [
        'config' => [
            'dbTable' => appDatabaseCs::formSearch,
            'cs_category' => appConfigStatus::csCategoryLog,
            'dropdown' => appRoutesWeb::sitemap['adminCsIndex']['path']
        ]
    ]); ?>
</article>
<?php appFuncModule::js('form-cs', ['target' => '#form-search']); ?>
<?php appFuncModule::js('pageload-submit-search', ['target' => '#form-search']); ?>