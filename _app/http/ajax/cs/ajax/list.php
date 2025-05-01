<?php
//======================================================================
// 対応ログ一覧
//======================================================================
class adminCsAjaxList
{
    public static $dbResultCs = []; //DBから取得した対応ログ
    public static $dbResultCsCount = 0; //DBから取得した対応ログの総数
    public static $path = ""; //文字列：対応ログを表示するぺージのパス
    public static $tableRow = []; //表示するDBの列
    public static $searchString = ""; //文字列：検索結果
}

adminCsAjaxList::$dbResultCs = appFuncCrmGet::getDataIndex($_GET);
adminCsAjaxList::$dbResultCsCount = appFuncCrmGet::count($_GET);
adminCsAjaxList::$path = appFuncArray::issetKey($_GET, 'path', '');
adminCsAjaxList::$tableRow = appFuncCrmGet::selectRow(adminCsAjaxList::$path);
adminCsAjaxList::$searchString = appFuncCrmDisp::searchString(adminCsAjaxList::$tableRow, $_GET);
