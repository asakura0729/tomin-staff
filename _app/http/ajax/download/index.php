<?php
//======================================================================
// CSVダウンロード
//======================================================================
class adminDownload
{
    public static $colCount = 10000; //データを表示できる最大件数
    public static $dbResult = []; //DBから取得した対応ログ
    public static $tableRow = []; //表示するDBの列
}
adminDownload::$dbResult = appFuncCrmGet::getDataIndex($_GET, adminDownload::$colCount);
adminDownload::$tableRow = appFuncCrmGet::selectRow(appFuncArray::issetKey($_GET, 'path', ''));
header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=\"list.csv\"");
