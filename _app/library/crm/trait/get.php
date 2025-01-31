<?php
//======================================================================
// CRM＞データ取得
//======================================================================
trait appLibraryCrmGet
{

    //======================================================================
    // 葬儀情報
    //======================================================================
    //-----------------------------------------------------
    // 葬儀情報を取得（一覧）
    //-----------------------------------------------------
    public static function getFuneral(): array
    {
        $sql = self::getFuneralSql();
        $dbresult = appFuncDatabase::getData($sql);
        foreach ($dbresult as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneral::table);
        }
        return $result;
    }
    //-----------------------------------------------------
    // 葬儀情報を取得（詳細）
    //-----------------------------------------------------
    public static function getFuneralDetail(): array
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $dbresult = [];
        if ($primaryKey != '') {
            /*分岐：葬儀IDが指定されている場合はDB通信を行う*/
            $sql = self::getFuneralSql();
            $sql .= ' WHERE ';
            $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
            $dbresult = appFuncDatabase::getSingleData($sql);
        }
        $result = appLibraryDataformat::dbResult($dbresult, appDatabaseFuneral::table);
        return $result;
    }
    //-----------------------------------------------------
    // 葬儀情報を取得＞SQL作成
    //-----------------------------------------------------
    public static function getFuneralSql(): string
    {
        $sql = appLibraryEditsql::requestSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table]);
        return $sql;
    }



    //======================================================================
    // 顧客情報
    //======================================================================
    //-----------------------------------------------------
    // 顧客情報を取得
    //-----------------------------------------------------
    public static function getClientData(): array
    {
        $result = [];
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        if ($primaryKey != '') {
            /*分岐：葬儀IDが指定されている場合はDB通信を行う*/
            $sql = self::getClientDataSql($primaryKey);
            $result = appFuncDatabase::getData($sql);
            foreach ($result as $index => $value) {
                $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclient::table);
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 顧客情報を取得＞SQL作成
    //-----------------------------------------------------
    public static function getClientDataSql($primaryKey): string
    {
        $sql = appLibraryEditsql::requestSql(['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table]);
        $sql .= ' WHERE ';
        $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
        return $sql;
    }

    //======================================================================
    // レポート
    //======================================================================
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得
    //-----------------------------------------------------
    public static function getCsReport(): array
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $sql = self::getCsReportSql($primaryKey);
        $result = appFuncDatabase::getData($sql);
        return $result;
    }
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得（最新一件）
    //-----------------------------------------------------
    public static function getCsReportLatest(): array
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $sql = self::getCsReportSql($primaryKey);
        $sql .= ' LIMIT 1';
        $result = appFuncDatabase::getData($sql);
        $resultContiner = appLibraryDataformat::dbResult($result, appDatabaseContainerCs::table);
        $resultReport = appLibraryDataformat::dbResult($result, appDatabaseReport::table);
        $resultReportCs = appLibraryDataformat::dbResult($result, appDatabaseReport::tableCs);
        $result = array_merge($resultContiner, $resultReport, $resultReportCs);
        return $result;
    }
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得＞SQL作成
    //-----------------------------------------------------
    public static function getCsReportSql(string $primaryKey): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseContainerCs::tableName, 'table' => appDatabaseContainerCs::table],
            ['primaryKey' => appDatabaseContainerCs::primaryKey, 'tableName' => appDatabaseReport::categoryCs, 'table' => appDatabaseReport::tableCs],
            ['primaryKey' => appDatabaseReport::primaryKey, 'tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table]
        );
        $sql .= ' WHERE ';
        $sql .= appDatabaseContainerCs::tableName . '.' . appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '" ';
        $sql .= ' ORDER BY ' . appDatabaseReport::categoryCs . '.' . appDatabaseReport::primaryKey . ' DESC ';
        return $sql;
    }
    //-----------------------------------------------------
    // レポートを取得
    //-----------------------------------------------------
    public static function getReport(string $category, array $table = [], string  $reportId = ""): array
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $reportId = appFuncArray::issetKey($_GET, appDatabaseReport::primaryKey, $reportId);
        $sql = self::getReportSql($primaryKey, $category, $table, $reportId);
        $result = appFuncDatabase::getData($sql);
        return $result;
    }
    //-----------------------------------------------------
    // レポートを取得(最新一件)
    //-----------------------------------------------------
    public static function getReportLatest($category, $table = []): array
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $sql = self::getReportSql($primaryKey, $category, $table);
        $sql .= ' LIMIT 1';
        $result = appFuncDatabase::getData($sql);
        if (isset($result[0])) {
            $result = $result[0];
        }
        return $result;
    }
    //-----------------------------------------------------
    // レポートを取得＞SQL作成
    //-----------------------------------------------------
    public static function getReportSql(string $primaryKey, string $category, array $table = [], string  $reportId = ""): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table],
            ['primaryKey' => appDatabaseReport::primaryKey, 'tableName' => $category, 'table' => $table]
        );
        $sql .= ' WHERE ';
        $sql .= $category . '.' . appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '" and ';
        $sql .= 'report_category="' .  $category . '" ';
        $sql .= ' ORDER BY ' . appDatabaseReport::tableName . '.' . appDatabaseReport::primaryKey . ' DESC ';
        return $sql;
    }
}
