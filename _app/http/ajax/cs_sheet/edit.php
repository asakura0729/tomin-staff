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
appConfigPage::$titleAdd = appFuncCrmDisp::pageTitleAdd(appHttpCssheetAjaxEdit::$dbResult);
