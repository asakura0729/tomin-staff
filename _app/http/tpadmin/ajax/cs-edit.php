<?php
//======================================================================
// 部品：入力フォーム
//======================================================================
class appHttpAjaxCsedit
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpAjaxCsedit::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpAjaxCsedit::$dbResult = appFuncCrmGet::tpadminCsAjax($_GET, appHttpAjaxCsedit::$postPrimaryKey);
