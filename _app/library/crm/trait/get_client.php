<?php
//======================================================================
// CRM＞データ取得＞顧客情報
//======================================================================
trait appLibraryCrmGetClient
{
    //-----------------------------------------------------
    // 顧客情報を取得
    //-----------------------------------------------------
    public static function getClientData(array $option = []): array
    {
        $sql = self::getClientDataSqlSelect();
        $sql .= self::getClientDataSqlWhere($option);
        $result = appFuncDatabase::getData($sql);
        foreach ($result as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclient::table);
        }
        return $result;
    }


    //======================================================================
    // SQL作成
    //======================================================================
    //-----------------------------------------------------
    // SQL作成＞select文追加
    //-----------------------------------------------------
    public static function getClientDataSqlSelect(): string
    {
        $sql = appLibraryEditsql::requestSql(['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table]);
        return $sql;
    }
    //-----------------------------------------------------
    // SQL作成＞Where句追加
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
}
