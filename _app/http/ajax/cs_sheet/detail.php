<?php
//======================================================================
// 送客シート詳細ページ
//======================================================================
class appHttpCssheetAjaxDetail
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
    public static $dbResultParent = []; //DBから取得した値(親要素)
    public static $overwriteBtnDisabled = true; //対応ログ引継ぎボタン活性・非活性(true...非活性)
}
appHttpCssheetAjaxDetail::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpCssheetAjaxDetail::$dbResult = appFuncCrmGet::csSheet($_GET, appHttpCssheetAjaxDetail::$postPrimaryKey, true);
appHttpCssheetAjaxDetail::$dbResultParent = appFuncCrmGet::csSheetParent(appHttpCssheetAjaxDetail::$dbResult);

if (appHttpCssheetAjaxDetail::$dbResultParent['approval_status'] === appConfigStatus::approval_status['complete']['key']) {
    /*分岐：親要素の対応ログは承認済み*/
    appHttpCssheetAjaxDetail::$overwriteBtnDisabled = false;
}

appConfigPage::$titleAdd = appFuncCrmDisp::pageTitleAdd(appHttpCssheetAjaxDetail::$dbResult);
appFuncCrmStorage::createCountFile(
    appHttpCssheetAjaxDetail::$postPrimaryKey,
    appRoutesWeb::async['adminCountCsSheet']['contents'],
    appConfigStatus::csCategorySheet
);
