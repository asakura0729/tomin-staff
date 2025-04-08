<?php
//======================================================================
// ページ：対応ログ　作成／編集
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/tpadmin/ajax/cs/edit.php'; ?>
<?php require_once '../_tmpl/ajax.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>

<article>
    <section id="sec-edit" class="p-3 pb-4">
        <?php appFuncModule::heading('h2', 'h2', '受電内容メモ', ['addCss' => 'pl-2 pb-2']); ?>
        <div id="<?php echo appConfigPage::secCsEdit; ?>" class="minh-200px">
            <?php appFuncModule::localModule('../../_module/form-edit', [
                'dbResult' => appHttpTpadminAjaxCsEdit::$dbResult,
                'postPrimaryKey' => ''
            ]); ?>
        </div>
    </section>
    <section id="sec-search" class="p-3">
        <?php appFuncModule::heading('h2', 'h2', '対応ログ検索', ['addCss' => 'pl-2']); ?>
        <?php appFuncModule::localModule('../../_module/form-search', [
            'config' => [
                'dbTable' => appDatabaseCs::formSearch,
                'dbResult' => [
                    'cs_category' => appConfigStatus::csCategoryLog,
                ],
                'dropdown' => appRoutesWeb::sitemap['adminCsIndex']['path']
            ]
        ]); ?>
    </section>
</article>