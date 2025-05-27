<?php
//======================================================================
// 部品：対応ログ　入力フォーム
//======================================================================
?>
<?php require_once '../../../_app/ssl_base.php'; ?>
<?php require_once '../../../_app/http/ajax/cs/ajax/post.php'; ?>

<?php appFuncModule::include('../../_module/form-edit.php', [
    'dbResult' => appHttpAjaxCsAjaxPost::$dbResult,
    'postPrimaryKey' => appHttpAjaxCsAjaxPost::$postPrimaryKey
]); ?>

<?php if (appHttpAjaxCsAjaxPost::$postPrimaryKey != ''): ?>
    <?php /*分岐1：データ更新*/ ?>
    <?php appFuncModule::component('alert-success'); ?>
    <?php appFuncModule::js('url-push', ['path' => appRoutesWeb::sitemap['adminCsEdit']['path'] . appFuncPath::setGetParam(['cs_id'], [appHttpAjaxCsAjaxPost::$postPrimaryKey])]); ?>
    <?php if (appHttpAjaxCsAjaxPost::$redirectFlg === true): ?>
         <?php /*分岐1：データ更新 + リダイレクト指定あり*/ ?>
         <?php appFuncModule::js('redirect', ['path' => appRoutesWeb::sitemap['adminCsSheetEdit']['contents'] . appFuncPath::setGetParam(['cs_id', appFuncCrmGet::getCloneFlg], [appHttpAjaxCsAjaxPost::$postPrimaryKey, 'true'])]); ?>
    <?php endif; ?>
<?php endif; ?>

<?php appFuncModule::include('../../_module/js-form-edit.php', ['dbResult' => appHttpAjaxCsAjaxPost::$dbResult]); ?>
<?php appFuncModule::js('totop'); ?>
<?php appFuncModule::js('message', ['target' => 'h1', 'msg' => appRoutesWeb::sitemap['adminCsEdit']['title'] . appFuncCrmDisp::pageTitleAdd(appHttpAjaxCsAjaxPost::$dbResult)]); ?>
<?php appFuncModule::js('hx-trigger-autoload'); ?>