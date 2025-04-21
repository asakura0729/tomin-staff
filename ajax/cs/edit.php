<?php
//======================================================================
// ページ：対応ログ　作成／編集
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/cs/edit.php'; ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<article>
    <section class="p-3 pb-5">
        <?php appFuncModule::heading('h2', 'h2', '受電内容メモ', ['addCss' => 'pl-2 pb-2']); ?>
        <div id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsEdit); ?>" class="minh-200px">
            <?php appFuncModule::include('../_module/form-edit.php', [
                'dbResult' => appHttpAjaxCsEdit::$dbResult,
                'postPrimaryKey' => ''
            ]); ?>
        </div>
        <?php appFuncModule::form('form-control', 0, ['inputName' => 'scroll', 'inputType' => 'hidden']); ?>
    </section>
    <section class="p-3 bg-base border-top border-bottom">
        <?php appFuncModule::heading('h2', 'h2', '対応ログ検索'); ?>
        <?php appFuncModule::include('../_module/form-search.php', [
            'path' => appConfigPage::$path,
            'dbTable' => appDatabaseCs::tableCsListMerge,
            'dbResult' => [
                'cs_category' => appConfigStatus::csCategoryLog,
            ]
        ]); ?>
    </section>
</article>

<?php appFuncModule::js('form-scroll', ['target' => appConfigSite::secCsEdit]); ?>