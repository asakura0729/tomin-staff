<?php
//======================================================================
// 部品：入力フォーム
//======================================================================
class appHttpForm_edit_cs
{
    public static $postPrimaryKey = ''; //DBに送信されたprimaryKeyの値
    public static $dbResult = []; //DBから取得した値
}
appHttpForm_edit_cs::$postPrimaryKey = appFuncCrmPost::csData($_POST);
appHttpForm_edit_cs::$dbResult = appFuncCrmGet::tpadminCsAjax($_GET, appHttpForm_edit_cs::$postPrimaryKey);
