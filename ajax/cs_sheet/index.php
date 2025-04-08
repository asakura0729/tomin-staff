<?php
//======================================================================
// ページ：送客シート一覧
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../_tmpl/ajax.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="animation-fadein p-3">
    <?php appFuncModule::localModule('../../_module/form-search', [
        'config' => [
            'dbTable' => appDatabaseCs::sheetTable,
            'cs_category' => appConfigStatus::csCategorySheet
        ]
    ]); ?>
</article>
<?php appFuncModule::js('pageload-submit-search', ['target' => '#form-search']); ?>