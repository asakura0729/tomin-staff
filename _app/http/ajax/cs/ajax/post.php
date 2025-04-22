<?php
//======================================================================
// 部品：転記フォーム
//======================================================================
class appHttpAjaxCsAjaxPost
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpAjaxCsAjaxPost::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpAjaxCsAjaxPost::$dbResult = appFuncCrmGet::csEdit($_GET, appHttpAjaxCsAjaxPost::$postPrimaryKey);
