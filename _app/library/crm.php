<?php
//======================================================================
// CRM
//======================================================================
class appLibraryCrm
{

    //-----------------------------------------------------
    // 葬儀情報を取得（最新一件）
    //-----------------------------------------------------
    public static function getLatest(): string
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table]
        );
        $sql .= ' WHERE deleteFlg!=' . appConfigDatabase::deleteFlgTrue;
        $sql .= ' ORDER BY ' . appDatabaseFuneral::primaryKey . ' DESC LIMIT 1';
        $dbresult = appFuncDatabase::getSingleData($sql);
        $result = $dbresult[appDatabaseFuneral::primaryKey];
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報を取得（一覧）
    //-----------------------------------------------------
    public static function getFuneral()
    {
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table]
        );
        $dbresult = appFuncDatabase::getData($sql);
        foreach ($dbresult as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneral::table);
        }
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報を取得（詳細）
    //-----------------------------------------------------
    public static function getFuneralDetail()
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $sql = appLibraryEditsql::requestSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table]);
        $dbresult = [];
        if ($primaryKey != '') {
            /*分岐：IDが指定されている場合はDB通信を行う*/
            $sql .= ' WHERE ';
            $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
            $sql .= ' and deleteFlg!=' . appConfigDatabase::deleteFlgTrue;
            $dbresult = appFuncDatabase::getSingleData($sql);
        }
        $result = appLibraryDataformat::dbResult($dbresult, appDatabaseFuneral::table);
        return $result;
    }

    //-----------------------------------------------------
    // 顧客情報を取得
    //-----------------------------------------------------
    public static function getClientData()
    {
        $getId = appFuncArray::issetKey($_GET, appDatabaseFuneralclient::primaryKey, '');
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table]
        );
        $result = appFuncDatabase::getData($sql);
        foreach ($result as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclient::table);
        }
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報を追加／更新
    //-----------------------------------------------------
    public static function confirmFuneralData()
    {
        if (isset($_POST[appConfigStatus::postType])) {
            $postType = $_POST[appConfigStatus::postType];
            self::updateFuneralData($postType);
            if ($postType === appConfigStatus::postTypeInsert) {
                $primaryKey = self::getLatest();
            } else {
                $primaryKey = $_POST[appDatabaseFuneral::primaryKey];
            }
            header('Location:' . appConfigSite::sitemap['adminCrmDetail']['path'] . '?funeral_id=' . $primaryKey);
            exit;
        }
    }

    //-----------------------------------------------------
    // 葬儀情報を追加／更新
    //-----------------------------------------------------
    public static function updateFuneralData($postType): bool
    {
        $post = self::updateFuneralDataFormat($_POST);
        $primaryKey = appFuncArray::issetKey($post, appDatabaseFuneral::primaryKey, '');
        if ($primaryKey != '') {
            /*分岐1：IDが存在する場合、上書き*/
            $sql = appLibraryEditsql::updateSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post]);
            $sql .= ' WHERE ';
            $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
            $sql .= ' and deleteFlg!=' . appConfigDatabase::deleteFlgTrue;
        } else {
            /*分岐2：IDが存在しない場合、新規追加*/
            $sql = appLibraryEditsql::insertSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post]);
        }
        $param = appLibraryDataformat::dbPost($post, appDatabaseFuneral::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
        /* header('Location:' . appConfigSite::sitemap['adminCrm']['path']);*/
    }

    //-----------------------------------------------------
    // 葬儀情報を追加／更新＞データ整形
    //-----------------------------------------------------
    public static function updateFuneralDataFormat($post): array
    {
        $funeral_date = new DateTime($post['funeral_date']);
        $post['funeral_date'] =  $funeral_date->format('Y-m-d');
        $post['totalpeople'] = intval($post['totalpeople']);
        return $post;
    }

    //-----------------------------------------------------
    // 顧客情報を追加／更新
    //-----------------------------------------------------
    public static function updateFuneralClientData($primaryKey)
    {
        $post = $_POST;
        if ($primaryKey != '') {
            $sql = appLibraryEditsql::updateSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post]);
            $param = appLibraryDataformat::dbPost($post, appDatabaseFuneral::table);
            $result = appFuncDatabase::updateData($sql, $param);
            if ($result == true) {
                header('Location:' . appConfigSite::sitemap['adminCrm']['path']);
            }
        }
    }
}
