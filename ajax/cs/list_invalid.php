<?php
//======================================================================
// ページ：対応ログ一覧＞無効電話一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php appFuncStorage::start(); ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php require_once '../_tmpl/page.php'; ?>
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
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appFuncCrmArray::invalidList(),
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
        ]
    ]); ?>
</article>
<?php appFuncMinify::minifySourceEnd(); ?>
<?php appFuncModule::include('../_module/js-form-search.php'); ?>
<?php appFuncStorage::end(); ?>