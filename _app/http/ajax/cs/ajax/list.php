<?php
//======================================================================
// 対応ログ一覧
//======================================================================
class adminCsAjaxList
{
    public static $dbResultCs = []; //DBから取得した対応ログ
    public static $dbResultCsCount = 0; //DBから取得した対応ログの総数
    public static $path = ""; //対応ログを表示しージのパス
    public static $searchString = ""; //検索結果
    public static $tableRow = []; //表示するDBの列
}
adminCsAjaxList::$dbResultCs = appFuncCrmGet::getDataIndex($_GET);
adminCsAjaxList::$dbResultCsCount = appFuncCrmGet::count($_GET);
adminCsAjaxList::$path = appFuncArray::issetKey($_GET, 'path', '');
adminCsAjaxList::$searchString = appFuncCrmGet::searchString($_GET);

switch (adminCsAjaxList::$path) {
    case appRoutesWeb::sitemap['adminCsIndex']['contents']:
    case appRoutesWeb::sitemap['adminCsEdit']['contents']:
    case appRoutesWeb::sitemap['adminCsList_check']['contents']:
        adminCsAjaxList::$tableRow = array_merge(appDatabaseCs::csList, appDatabaseCs::csListJoin);
        break;
    case appRoutesWeb::sitemap['adminCsList_invalid']['contents']:
        adminCsAjaxList::$tableRow = appDatabaseCs::tableInvalid;
        break;
    case appRoutesWeb::sitemap['adminCsSeetDetail']['contents']:
        adminCsAjaxList::$tableRow = appDatabaseCs::csListSheet;
        break;
    default:
        adminCsAjaxList::$tableRow = appDatabaseCs::table;
        break;
}
