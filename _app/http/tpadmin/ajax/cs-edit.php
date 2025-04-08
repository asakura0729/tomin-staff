<?php
//======================================================================
// 部品：入力フォーム
//======================================================================
class appHttpTpadminAjaxCsedit
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpTpadminAjaxCsedit::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpTpadminAjaxCsedit::$dbResult = appFuncCrmGet::tpadminCsAjax($_GET, appHttpTpadminAjaxCsedit::$postPrimaryKey);
