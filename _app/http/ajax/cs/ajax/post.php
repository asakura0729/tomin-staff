<?php
//======================================================================
// 部品：対応ログ編集フォーム／転記フォーム
//======================================================================
class appHttpAjaxCsAjaxPost
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
    public static $redirectFlg = false; //リダイレクトの有無（true...リダイレクト）
}
appHttpAjaxCsAjaxPost::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpAjaxCsAjaxPost::$redirectFlg = appFuncArray::issetKey($_POST, 'redirect_flg', '') == 'true'  ? true : false;
appHttpAjaxCsAjaxPost::$dbResult = appFuncCrmGet::csEdit($_GET, appHttpAjaxCsAjaxPost::$postPrimaryKey);
appFuncCrmStorage::createFile(
    appHttpAjaxCsAjaxPost::$postPrimaryKey,
    appRoutesWeb::async['adminCountCs']['contents'],
    appConfigStatus::csCategoryLog
);
