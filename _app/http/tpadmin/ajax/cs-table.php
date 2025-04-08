<?php
//======================================================================
// 対応ログ一覧
//======================================================================
class appHttpAjaxCstable
{
    public static $dbResultCs = []; //DBから取得した対応ログ
    public static $dbResultCsCount = 0; //DBから取得した対応ログの総数
    public static $csCategory = "";
    public static $searchString = ""; //検索結果
    public static $target = ""; //対応ログ表示対象
    public static $tableRow = [];
}
appHttpAjaxCstable::$dbResultCs = appFuncCrmGet::getDataIndex($_GET);
appHttpAjaxCstable::$dbResultCsCount = appFuncCrmGet::count($_GET);
appHttpAjaxCstable::$csCategory = appFuncArray::issetKey($_GET, 'cs_category', '');
appHttpAjaxCstable::$target = appFuncArray::issetKey($_GET, 'target', '');
appHttpAjaxCstable::$searchString = appFuncCrmGet::searchString($_GET);

if (isset($_GET['cs_category'])) {
    switch ($_GET['cs_category']) {
        case appConfigStatus::csCategoryLog:
            appHttpAjaxCstable::$tableRow = appDatabaseCs::table;
            break;
        case appConfigStatus::csCategorySheet:
            appHttpAjaxCstable::$tableRow = appDatabaseCs::csListSheet;
            break;
        default:
            break;
    }
}
