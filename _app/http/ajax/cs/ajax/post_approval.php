<?php
//======================================================================
// 部品：対応ログ（承認）
//======================================================================
class appHttpAjaxCsAjaxPost_approval
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpAjaxCsAjaxPost_approval::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpAjaxCsAjaxPost_approval::$dbResult = appFuncCrmGet::csEdit($_GET, appHttpAjaxCsAjaxPost_approval::$postPrimaryKey);
appFuncCrmStorage::createFile(
    appHttpAjaxCsAjaxPost_approval::$postPrimaryKey,
    appRoutesWeb::async['adminCountCs']['contents'],
    appConfigStatus::csCategoryLog
);