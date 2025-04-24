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
adminCsAjaxList::$path = appFuncArray::issetKey($_GET, 'path', '');
adminCsAjaxList::$dbResultCs = appFuncCrmGet::getDataIndex($_GET);
adminCsAjaxList::$dbResultCsCount = appFuncCrmGet::count($_GET);
switch (adminCsAjaxList::$path) {
    case appRoutesWeb::sitemap['adminCsIndex']['contents']:
    case appRoutesWeb::sitemap['adminCsEdit']['contents']:
    case appRoutesWeb::sitemap['adminCsList_check']['contents']:
        /*分岐1：通常*/
        adminCsAjaxList::$tableRow = appFuncCrmDisp::renameTitles(appFuncCrmArray::list());
        break;
    case appRoutesWeb::sitemap['adminCsList_invalid']['contents']:
        /*分岐2：無効電話一覧*/
        adminCsAjaxList::$tableRow = appFuncCrmDisp::renameTitles(appFuncCrmArray::invalidList());
        break;
    case appRoutesWeb::sitemap['adminCsSheet']['contents']:
        /*分岐3：送客シート*/
        adminCsAjaxList::$tableRow = appFuncCrmDisp::renameTitles(appFuncCrmArray::sheetList());
        break;
    default:
        adminCsAjaxList::$tableRow = appDatabaseCs::table;
        break;
}
adminCsAjaxList::$searchString = appFuncCrmDisp::searchString(adminCsAjaxList::$tableRow, $_GET);
