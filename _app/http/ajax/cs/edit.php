<?php
//======================================================================
// 部品：入力フォーム
//======================================================================
class appHttpAjaxCsEdit
{
    public static $dbResult = []; //DBから取得した値
    
}
appHttpAjaxCsEdit::$dbResult = appFuncCrmGet::csEdit($_GET);
appConfigPage::$titleAdd = appFuncCrmDisp::pageTitleAdd(appHttpAjaxCsEdit::$dbResult);
