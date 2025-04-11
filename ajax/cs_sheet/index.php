<?php
//======================================================================
// ページ：送客シート一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="animation-fadein p-3">
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appDatabaseCs::tableForm,
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategorySheet
        ]
    ]); ?>
</article>
<?php appFuncModule::js('pageload-submit-search', ['target' => '#form-search']); ?>