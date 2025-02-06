<?php
//======================================================================
// CRM＞データ取得＞顧客情報
//======================================================================
trait appLibraryCrmGetClient
{
    //======================================================================
    // 顧客情報取得
    //======================================================================
    //-----------------------------------------------------
    // データ取得
    //-----------------------------------------------------
    public static function getClientData(array $option = []): array
    {
        $sql = self::getClientDataSqlSelect();
        $sql .= self::getClientDataSqlWhere($option);
        $sql .= self::getClientDataSqlOrder();
        $result = appFuncDatabase::getData($sql);
        foreach ($result as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclient::table);
        }
        return $result;
    }
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
    public static function getClientDataSqlWhere(array $option): string
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
    //-----------------------------------------------------
    // SQL作成＞ORDER句作成
    //-----------------------------------------------------
    public static function getClientDataSqlOrder(): string
    {
        $sql = ' ORDER BY ' . appDatabaseFuneralclient::tableName . '.' . appDatabaseFuneralclient::primaryKey . ' DESC';
        return $sql;
    }

    //======================================================================
    // 顧客情報を取得(葬儀情報結合)
    //======================================================================
    //-----------------------------------------------------
    // データ取得
    //-----------------------------------------------------
    public static function getClientDataJoinFuneral(array $option = []): array
    {
        $sql = self::getClientDataJoinFuneralSqlSelect();
        $sql .= self::getClientDataJoinFuneralSqlWhere($option);
        $result = appFuncDatabase::getData($sql);
        foreach ($result as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclientView::table);
        }
        return $result;
    }
    //-----------------------------------------------------
    // 総数を取得
    //-----------------------------------------------------
    public static function getClientDataJoinFuneralCount(array $option = []): string
    {
        $sql = appLibraryEditsql::getCount(appDatabaseFuneralclientView::tableName, appDatabaseFuneralclientView::primaryKey);
        $sql .= self::getClientDataJoinFuneralSqlWhere($option);
        $dbresult = appFuncDatabase::getData($sql);
        $result = $dbresult[0]['count'];
        return $result;
    }
    //-----------------------------------------------------
    // SQL作成＞select文追加
    //-----------------------------------------------------
    public static function getClientDataJoinFuneralSqlSelect(): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseFuneralclientView::tableName, 'table' =>  appDatabaseFuneralclientView::table],
        );
        return $sql;
    }
    //-----------------------------------------------------
    // SQL作成＞Where句追加
    //-----------------------------------------------------
    public static function getClientDataJoinFuneralSqlWhere(array $option): string
    {
        $sql = " WHERE ";
        $sql .= appLibraryEditsql::deleteFlgFalse(appDatabaseFuneralclientView::tableName);
        $sql .= ' AND ' . appDatabaseFuneralclientView::table['funeral_category'][appConfigDatabase::row] === appDatabaseFuneral::categoryValid;
        $word = appFuncArray::issetKey($option, appRoutesWeb::getWords, '');
        $row = appFuncArray::issetKey($option, appRoutesWeb::getRow, appLibraryCrm::searchClname);
        if (isset(appLibraryCrm::searchRows[$row])) {
            if ($word != '' && $row != '') {
                /*分岐：キーワード指定あり*/
                $sql .= appLibraryEditsql::whereKeywords($word, appLibraryCrm::searchRows[$row]['rows']);
            }
        }
        return $sql;
    }
    //-----------------------------------------------------
    // SQL作成＞ORDER句作成
    //-----------------------------------------------------
    public static function getClientDataJoinFuneralSqlOrder(): string
    {
        $sql = ' ORDER BY ' . appDatabaseFuneralclientView::table . '.' . appDatabaseFuneralclientView::primaryKey . ' DESC';
        return $sql;
    }
}
