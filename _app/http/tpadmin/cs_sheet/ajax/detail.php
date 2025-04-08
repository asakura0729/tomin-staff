<?php
//======================================================================
// 送客シート詳細ページ
//======================================================================
class appHttpTpadminCssheetAjaxDetail
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}

appHttpTpadminCssheetAjaxDetail::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpTpadminCssheetAjaxDetail::$dbResult = appFuncCrmGet::tpadminCsSheetAjax($_GET, appHttpTpadminCssheetAjaxDetail::$postPrimaryKey, true);