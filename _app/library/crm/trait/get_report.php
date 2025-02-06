<?php
//======================================================================
// CRM＞データ取得＞レポート
//======================================================================
trait appLibraryCrmGetReport
{
    //======================================================================
    // 通常レポート
    //======================================================================
    //-----------------------------------------------------
    // レポートIDを取得
    //-----------------------------------------------------
    public static function getReportId(): string
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseReport::primaryKey, '');
        return $primaryKey;
    }
    //-----------------------------------------------------
    // レポートを取得(一覧表示)
    //-----------------------------------------------------
    public static function getReport(string $category, array $table = [], $option = []): array
    {
        $sql = self::getReportSql($category, $table);
        $sql .= self::getReportSqlWhere($category, $option);
        $sql .= ' ORDER BY ' . appDatabaseReport::tableName . '.' . appDatabaseReport::primaryKey . ' DESC ';
        $result = appFuncDatabase::getData($sql);
        return $result;
    }
    //-----------------------------------------------------
    // レポートを取得＞SQL作成＞SELECT文
    //-----------------------------------------------------
    public static function getReportSql(string $category, array $table = []): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table],
            ['primaryKey' => appDatabaseReport::primaryKey, 'tableName' => $category, 'table' => $table]
        );
        $sql .= ' WHERE ';
        return $sql;
    }
    //-----------------------------------------------------
    // レポートを取得＞SQL作成＞絞り込み句追加
    //-----------------------------------------------------
    public static function getReportSqlWhere(string $category = "", array $option = []): string
    {
        $sql = "";
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        $reportId = appFuncArray::issetKey($option, appDatabaseReport::primaryKey, '');
        if ($funeralId != '') {
            /*分岐：葬儀ID指定あり*/
            $sql .=  $category . '.' . appDatabaseFuneral::primaryKey . '="' .  $funeralId . '" and ';
        }
        if ($reportId != '') {
            /*分岐：レポートID指定あり*/
            $sql .= appDatabaseReport::tableName . '.' . appDatabaseReport::primaryKey . '="' .  $reportId . '" and ';
        }
        $sql .= 'report_category="' .  $category . '" ';
        return $sql;
    }

    //======================================================================
    // 顧客情報まとめ
    //======================================================================
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得(一覧表示)
    //-----------------------------------------------------
    public static function getCsReport(array $option = []): array
    {
        $sql = self::getCsReportSql();
        $sql .= self::getCsReportSqlWhere($option);
        $sql .= self::getCsReportSqlOrder();
        $result = appFuncDatabase::getData($sql);
        return $result;
    }
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得(一件表示)
    //-----------------------------------------------------
    public static function getCsReportDetail(array $option = []): array
    {
        $dbResult = [];
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        if ($funeralId != '') {
            $sql = self::getCsReportSql();
            $sql .= self::getCsReportSqlWhere($option);
            $sql .= ' and ' . appDatabaseContainerCs::tableName . '.' . appDatabaseContainerCs::approval_status . '!="' . appDatabaseContainerCs::statusSuccess . '"';
            $sql .= self::getCsReportSqlOrder();
            $dbResult = appFuncDatabase::getData($sql);
        }
        if (count($dbResult) > 0) {
            $dbResult = $dbResult[0];
            $dbResult[appDatabaseContainerCs::approval_status] = appLibraryDataformat::dbResultSetDefaultVal($dbResult, appDatabaseContainerCs::table, appDatabaseContainerCs::approval_status);
        } else {
            $dbResult = [];
        }
        $resultContiner = appLibraryDataformat::dbResult($dbResult, appDatabaseContainerCs::table);
        $resultReport = appLibraryDataformat::dbResult($dbResult, appDatabaseReport::table);
        $resultReportCs = appLibraryDataformat::dbResult($dbResult, appDatabaseReport::tableCs);
        $result = appFuncArray::arrayMerge([$resultContiner, $resultReportCs, $resultReport]);
        return $result;
    }
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得＞SQL作成＞SELECT文作成
    //-----------------------------------------------------
    public static function getCsReportSql(): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseContainerCs::tableName, 'table' => appDatabaseContainerCs::table],
            ['primaryKey' => appDatabaseContainerCs::primaryKey, 'tableName' => appDatabaseReport::categoryCs, 'table' => appDatabaseReport::tableCs, 'filter' => ['cs_category']],
            ['primaryKey' => appDatabaseReport::primaryKey, 'tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table]
        );
        return $sql;
    }
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得＞SQL作成＞WHERE句作成
    //-----------------------------------------------------
    public static function getCsReportSqlWhere(array $option): string
    {
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        $sql = ' WHERE ' . appDatabaseReport::tableName . '.' . appDatabaseReport::categoryRow . '="' .  appDatabaseReport::categoryCs . '" ';
        if ($funeralId != '') {
            /*分岐：葬儀ID指定あり*/
            $sql .=  ' AND ' . appDatabaseContainerCs::tableName . '.' . appDatabaseFuneral::primaryKey . '="' .  $funeralId . '" ';
        }
        return $sql;
    }
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得＞SQL作成＞Order句作成
    //-----------------------------------------------------
    public static function getCsReportSqlOrder(): string
    {
        $sql = ' ORDER BY ' . appDatabaseContainerCs::tableName . '.' . appDatabaseContainerCs::primaryKey . ' DESC,';
        $sql .= appDatabaseReport::tableName . '.' . appDatabaseReport::primaryKey . ' DESC';
        return $sql;
    }
}
