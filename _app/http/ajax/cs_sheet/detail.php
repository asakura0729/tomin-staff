<?php
//======================================================================
// 送客シート詳細ページ
//======================================================================
class appHttpCssheetAjaxDetail
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpCssheetAjaxDetail::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpCssheetAjaxDetail::$dbResult = appFuncCrmGet::csSheet($_GET, appHttpCssheetAjaxDetail::$postPrimaryKey, true);
appConfigPage::$titleAdd = appFuncCrmDisp::pageTitleAdd(appHttpCssheetAjaxDetail::$dbResult);

appFuncCrmStorage::createCountFile(
    appHttpCssheetAjaxDetail::$postPrimaryKey,
    appRoutesWeb::async['adminCountCsSheet']['contents'],
    appConfigStatus::csCategorySheet
);

