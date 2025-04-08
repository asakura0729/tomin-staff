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
appHttpCssheetAjaxEdit::$dbResult = appFuncCrmGet::tpadminCsSheetAjax($_GET, appHttpCssheetAjaxEdit::$postPrimaryKey, false, false);

if (appHttpCssheetAjaxEdit::$dbResult[appDatabaseCs::primaryKey] != '') {
    /*分岐1：既存データ*/
    appConfigPage::$titleAdd = '（依頼者：' . appHttpCssheetAjaxEdit::$dbResult['client_name'] . '&nbsp;様）';
} else {
    /*分岐2：新規作成*/
    appHttpCssheetAjaxEdit::$dbResult['title'] = '送客シート';
    appHttpCssheetAjaxEdit::$dbResult['cs_date'] = date('Y-m-d');
    appHttpCssheetAjaxEdit::$dbResult['parent_cs_id'] = $_GET[appDatabaseCs::primaryKey];
    appHttpCssheetAjaxEdit::$dbResult['cs_category'] = appConfigStatus::csCategorySheet;
    appConfigPage::$titleAdd = '（新規作成）';
}