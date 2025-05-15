<?php
//======================================================================
// ページ：対応ログ一覧＞ログチェック一覧
//======================================================================
?>
<?php require_once '../../_app/ssl_base.php'; ?>
<?php appFuncStorage::start(); ?>
<?php appFuncMinify::minifySourceStart(); ?>
<?php require_once '../_tmpl/page.php'; ?>
<?php appFuncModule::heading('h1', 'h1', appConfigPage::$title); ?>
<div data-layout-wide>
    <div class="pos-sticky text-center"><?php appFuncModule::string('exclamation', '管理者のみが閲覧・編集できるページです'); ?></div>
</div>
<article class="p-3">
    <form id="<?php echo appFuncString::exclusionHash(appConfigSite::secCsEdit); ?>" data-hx-post="<?php echo appRoutesWeb::async['adminCsAjaxPost_approval']['contents']; ?>" data-hx-target="#sec-alert">
        <?php appFuncModule::form('form-control', "", ['inputName' => appDatabaseCs::table['cs_id']['name'], 'inputType' => 'hidden']); ?>
        <?php appFuncModule::form('form-control', $_SESSION[appConfigSession::userId], ['inputName' => appDatabaseCs::table['approval_by']['name'], 'inputType' => 'hidden']); ?>
        <?php appFuncModule::form('form-control', appConfigStatus::approval_status['complete']['key'], ['inputName' => appDatabaseCs::table['approval_status']['name'], 'inputType' => 'hidden']); ?>
        <div id="sec-alert"></div>
    </form>
    <?php appFuncModule::include('../_module/form-search.php', [
        'path' => appConfigPage::$path,
        'dbTable' => appFuncCrmArray::form(),
        'dbResult' => [
            'cs_category' => appConfigStatus::csCategoryLog,
            'approval_status' => appConfigStatus::approval_status['progress']['key'],
        ]
    ]); ?>
</article>
<?php appFuncMinify::minifySourceEnd(); ?>
<?php appFuncModule::include('../_module/js-form-search.php'); ?>
<?php appFuncStorage::end(); ?>