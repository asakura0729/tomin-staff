<?php
//======================================================================
// 対応ログ一覧
//======================================================================
class appHttpAjaxCstable
{
    public static $dbResultCs = []; //DBから取得した対応ログ
    public static $dbResultCsCount = 0; //DBから取得した対応ログの総数
    public static $path = ""; //対応ログを表示しているページのパス
    public static $searchString = ""; //検索結果
    public static $target = ""; //対応ログ表示対象
    public static $tableRow = [];
}
appHttpAjaxCstable::$dbResultCs = appFuncCrmGet::getDataIndex($_GET);
appHttpAjaxCstable::$dbResultCsCount = appFuncCrmGet::count($_GET);
appHttpAjaxCstable::$path = appFuncArray::issetKey($_GET, 'path', '');
appHttpAjaxCstable::$target = appFuncArray::issetKey($_GET, 'target', '');
appHttpAjaxCstable::$searchString = appFuncCrmGet::searchString($_GET);

switch (appHttpAjaxCstable::$path) {
    case appRoutesWeb::sitemap['adminCsIndex']['contents']:
    case appRoutesWeb::sitemap['adminCsEdit']['contents']:
    case appRoutesWeb::sitemap['adminCsList_check']['contents']:
        appHttpAjaxCstable::$tableRow = appDatabaseCs::table;
        break;
    case appRoutesWeb::sitemap['adminCsList_invalid']['contents']:
        appHttpAjaxCstable::$tableRow = appDatabaseCs::tableInvalid;
        break;
    case appRoutesWeb::sitemap['adminCsSeetDetail']['contents']:
        appHttpAjaxCstable::$tableRow = appDatabaseCs::csListSheet;
        break;
    default:
        appHttpAjaxCstable::$tableRow = appDatabaseCs::table;
        break;
}
