<?php
//======================================================================
// 対応ログ一覧
//======================================================================
class appHttpTpadminAjaxCstable
{
    public static $dbResultCs = []; //DBから取得した対応ログ
    public static $dbResultCsCount = 0; //DBから取得した対応ログの総数
    public static $csCategory = "";
    public static $searchString = ""; //検索結果
    public static $target = ""; //対応ログ表示対象
    public static $tableRow = [];
}
appHttpTpadminAjaxCstable::$dbResultCs = appFuncCrmGet::getDataIndex($_GET);
appHttpTpadminAjaxCstable::$dbResultCsCount = appFuncCrmGet::count($_GET);
appHttpTpadminAjaxCstable::$csCategory = appFuncArray::issetKey($_GET, 'cs_category', '');
appHttpTpadminAjaxCstable::$target = appFuncArray::issetKey($_GET, 'target', '');
appHttpTpadminAjaxCstable::$searchString = appFuncCrmGet::searchString($_GET);

if (isset($_GET['cs_category'])) {
    switch ($_GET['cs_category']) {
        case appConfigStatus::csCategoryLog:
            appHttpTpadminAjaxCstable::$tableRow = appDatabaseCs::table;
            break;
        case appConfigStatus::csCategorySheet:
            appHttpTpadminAjaxCstable::$tableRow = appDatabaseCs::csListSheet;
            break;
        default:
            break;
    }
}
