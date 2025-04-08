<?php
//======================================================================
// ページ：対応ログ一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../_tmpl/ajax.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<style>
    /*
    検索フォームの「ステータス」列のモーダル「有効注文」は操作できないように制御
    */
    [data-label-client_category="<?php echo appConfigStatus::clientCategoryValid; ?>"] {
        background: #eee;
        pointer-events: none;
        opacity: 0.5;
    }
</style>
<article class="p-3">
    <?php appFuncModule::localModule('../_module/form-search', [
        'path' => appConfigPage::$path,
        'dbTable' => appDatabaseCs::tableInvalid,
        'client_category_filter' => appConfigStatus::clientCategoryInvalid,
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
        ]
    ]); ?>
</article>
<?php appFuncModule::js('form-cs', ['target' => '#form-search']); ?>
<?php appFuncModule::js('pageload-submit-search', ['target' => '#form-search']); ?>