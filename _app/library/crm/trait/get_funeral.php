<?php
//======================================================================
// CRM＞データ取得＞葬儀情報
//======================================================================
trait appLibraryCrmGetFuneral
{

    //======================================================================
    // 葬儀IDを取得
    //======================================================================
    public static function getFuneralId(): string
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        return $primaryKey;
    }
    //======================================================================
    // 葬儀情報取得
    //======================================================================
    //-----------------------------------------------------
    // データ取得（一件）
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
        } else {
            $result = appLibraryDataformat::dbResult([], appDatabaseFuneral::table);
        }
        return $result;
    }
    //-----------------------------------------------------
    // データ取得（一覧）
    //-----------------------------------------------------
    public static function getFuneral(array $option = []): array
    {
        $result = [];
        $sql = self::getFuneralSqlSelect();
        $sql .= self::getFuneralSqlWhere($option);
        $sql .= self::getFuneralSqlOrder();
        $dbresult = appFuncDatabase::getData($sql);
        if (count($dbresult) > 0) {
            foreach ($dbresult as $index => $value) {
                $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneral::table);
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 総数を取得
    //-----------------------------------------------------
    public static function getFuneralCount(array $option = []): string
    {
        $sql = appLibraryEditsql::getCount(appDatabaseFuneral::tableName, appDatabaseFuneral::primaryKey);
        $sql .= self::getFuneralSqlWhere($option);
        $dbresult = appFuncDatabase::getData($sql);
        $result = $dbresult[0]['count'];
        return $result;
    }
    //-----------------------------------------------------
    // SQL作成＞SELECT文作成
    //-----------------------------------------------------
    public static function getFuneralSqlSelect(): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table]
        );
        return $sql;
    }
    //-----------------------------------------------------
    // SQL作成＞絞り込み句作成
    //-----------------------------------------------------
    public static function getFuneralSqlWhere($option = []): string
    {
        $sql = ' WHERE ';
        $sql .= appLibraryEditsql::deleteFlgFalse(appDatabaseFuneral::tableName);
        $funeralId = appFuncArray::issetKey($option, appDatabaseFuneral::primaryKey, '');
        if ($funeralId != '') {
            /*分岐：葬儀ID指定あり*/
            $sql .= ' AND ' . appDatabaseFuneral::primaryKey . '="' .  $funeralId . '"';
        }
        return $sql;
    }
    //-----------------------------------------------------
    // SQL作成＞ORDER句作成
    //-----------------------------------------------------
    public static function getFuneralSqlOrder(): string
    {
        $sql = ' ORDER BY ' . appDatabaseFuneral::tableName . '.' . appDatabaseFuneral::primaryKey . ' DESC';
        return $sql;
    }
}
