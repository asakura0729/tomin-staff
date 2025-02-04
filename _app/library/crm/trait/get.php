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
    // 葬儀IDを取得
    //-----------------------------------------------------
    public static function getFuneralId(): string
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        return $primaryKey;
    }
    //-----------------------------------------------------
    // 葬儀情報を取得(一覧表示)
    //-----------------------------------------------------
    public static function getFuneral(array $option = []): array
    {
        $sql = self::getFuneralSql();
        $sql .= self::getFuneralSqlWhere($option);
        $dbresult = appFuncDatabase::getData($sql);
        foreach ($dbresult as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneral::table);
        }
        return $result;
    }
    //-----------------------------------------------------
    // 葬儀情報を取得(1件表示)
    //-----------------------------------------------------
    public static function getFuneralDetail(array $option = []): array
    {
        $result = [];
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        if ($funeralId != '') {
            $result = self::getFuneral($option);
        }
        if (count($result) > 0) {
            $result = $result[0];
        }
        $result = appLibraryDataformat::dbResult([], appDatabaseFuneral::table);
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
    //-----------------------------------------------------
    // 葬儀情報を取得＞SQL作成＞絞り込み句追加
    //-----------------------------------------------------
    public static function getFuneralSqlWhere($option): string
    {
        $sql = "";
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        if ($funeralId != '') {
            $sql = ' WHERE ';
            $sql .= appDatabaseFuneral::primaryKey . '="' .  $funeralId . '"';
        }
        return $sql;
    }


    //======================================================================
    // 顧客情報
    //======================================================================
    //-----------------------------------------------------
    // 顧客情報を取得(一覧表示)
    //-----------------------------------------------------
    public static function getClientData(array $option = []): array
    {
        $sql = self::getClientDataSql();
        $sql .= self::getClientDataSqlWhere($option);
        $result = appFuncDatabase::getData($sql);
        foreach ($result as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclient::table);
        }
        return $result;
    }
    //-----------------------------------------------------
    // 顧客情報を取得＞SQL作成
    //-----------------------------------------------------
    public static function getClientDataSql(): string
    {
        $sql = appLibraryEditsql::requestSql(['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table]);
        return $sql;
    }
    //-----------------------------------------------------
    // 顧客情報を取得＞SQL作成＞Where句追加
    //-----------------------------------------------------
    public static function getClientDataSqlWhere($option): string
    {
        $sql = "";
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        if ($funeralId != '') {
            /*分岐：葬儀ID指定あり*/
            $sql = ' WHERE ';
            $sql .= appDatabaseFuneral::primaryKey . '="' .  $funeralId . '"';
        }
        return $sql;
    }

    //======================================================================
    // レポート
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
    // レポートを取得＞SQL作成
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
    // レポート＞顧客情報まとめ
    //======================================================================
    //-----------------------------------------------------
    // コンテナ（顧客対応まとめ）を取得(一覧表示)
    //-----------------------------------------------------
    public static function getCsReport(array $option = []): array
    {
        $sql = self::getCsReportSql();
        $sql .= self::getCsReportSqlWhere($option);
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
            $dbResult = appFuncDatabase::getData($sql);
        }
        if (count($dbResult) > 0) {
            $dbResult[appDatabaseContainerCs::approval_status] = appLibraryDataformat::dbResultSetDefaultVal($dbResult[0], appDatabaseContainerCs::table, appDatabaseContainerCs::approval_status);
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
    // コンテナ（顧客対応まとめ）を取得＞SQL作成
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
        $sql = '';
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        if ($funeralId != '') {
            /*分岐：葬儀ID指定あり*/
            $sql = ' WHERE ' . appDatabaseContainerCs::tableName . '.' . appDatabaseFuneral::primaryKey . '="' .  $funeralId . '" ';
        }
        return $sql;
    }
}
