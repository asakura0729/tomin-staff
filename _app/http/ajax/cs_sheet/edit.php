<?php
//======================================================================
// 送客シート編集ページ
//======================================================================
class appHttpCssheetAjaxEdit
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpCssheetAjaxEdit::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpCssheetAjaxEdit::$dbResult = appFuncCrmGet::csSheet($_GET, appHttpCssheetAjaxEdit::$postPrimaryKey, false, false);

if (appHttpCssheetAjaxEdit::$dbResult[appDatabaseCs::primaryKey] != '') {
    /*分岐1：既存データ*/
    appConfigPage::$titleAdd = '（依頼者：' . appHttpCssheetAjaxEdit::$dbResult['client_name'] . '&nbsp;様）';
} else {
    /*分岐2：新規作成*/
    appConfigPage::$titleAdd = '（新規作成）';
}