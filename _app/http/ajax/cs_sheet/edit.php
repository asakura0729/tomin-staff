<?php
//======================================================================
// 送客シート編集ページ
//======================================================================
class appHttpCssheetAjaxEdit
{
    public static $dbResult = []; //DBから取得した値
}
appHttpCssheetAjaxEdit::$dbResult = appFuncCrmGet::csSheet($_GET, '', false, false);
appConfigPage::$titleAdd = appFuncCrmDisp::pageTitleAdd(appHttpCssheetAjaxEdit::$dbResult);
