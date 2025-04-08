<?php
//======================================================================
// 送客シート編集ページ
//======================================================================
class appHttpTpadminCssheetAjaxEdit
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpTpadminCssheetAjaxEdit::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpTpadminCssheetAjaxEdit::$dbResult = appFuncCrmGet::tpadminCsSheetAjax($_GET, appHttpTpadminCssheetAjaxEdit::$postPrimaryKey, false, false);

if (appHttpTpadminCssheetAjaxEdit::$dbResult[appDatabaseCs::primaryKey] != '') {
    /*分岐1：既存データ*/
    appConfigPage::$titleAdd = '（依頼者：' . appHttpTpadminCssheetAjaxEdit::$dbResult['client_name'] . '&nbsp;様）';
} else {
    /*分岐2：新規作成*/
    appHttpTpadminCssheetAjaxEdit::$dbResult['title'] = '送客シート';
    appHttpTpadminCssheetAjaxEdit::$dbResult['cs_date'] = date('Y-m-d');
    appHttpTpadminCssheetAjaxEdit::$dbResult['parent_cs_id'] = $_GET[appDatabaseCs::primaryKey];
    appHttpTpadminCssheetAjaxEdit::$dbResult['cs_category'] = appConfigStatus::csCategorySheet;
    appConfigPage::$titleAdd = '（新規作成）';
}