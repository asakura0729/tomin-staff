<?php
//======================================================================
// ページ：対応ログ　作成／編集
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs/edit.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article class="p-3">
    <section class="pb-4">
        <?php appFuncModule::heading('h2', 'h2', '受電内容メモ', ['addCss' => 'pl-2 pb-2']); ?>
        <div id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsEdit); ?>" class="minh-200px">
            <?php appFuncModule::include('../_module/form-edit.php', [
                'dbResult' => appHttpAjaxCsEdit::$dbResult,
                'postPrimaryKey' => ''
            ]); ?>
        </div>
    </section>
    <section class="pt-4">
        <?php appFuncModule::heading('h2', 'h2', '対応ログ検索', ['addCss' => 'pl-2']); ?>
        <?php appFuncModule::include('../_module/form-search.php', [
            'path' => appConfigPage::$path,
            'dbTable' => appDatabaseCs::formSearch,
            'dbResult' => [
                'cs_category' => appConfigStatus::csCategoryLog,
            ]
        ]); ?>
    </section>
</article>