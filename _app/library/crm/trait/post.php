<?php
//======================================================================
// CRM＞データ送信
//======================================================================
trait appLibraryCrmPost
{

    //======================================================================
    // 葬儀情報追加・更新
    //======================================================================
    //-----------------------------------------------------
    // 葬儀情報追加・更新＞更新対象の葬儀IDを取得
    //-----------------------------------------------------
    public static function postFuneralId(): array
    {
        $result[appDatabaseFuneral::primaryKey] = "";
        if (isset($_POST[appDatabaseFuneral::primaryKey])) {
            if ($_POST[appDatabaseFuneral::primaryKey] != '') {
                /*分岐1：更新*/
                $result[appDatabaseFuneral::primaryKey] = $_POST[appDatabaseFuneral::primaryKey];
            } else {
                /*分岐2：新規*/
                $dbresult = self::insertFuneralData();
                $result[appDatabaseFuneral::primaryKey] = $dbresult[appFuncDatabase::updateDataLastInsertId];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 葬儀情報追加・更新＞葬儀情報を追加
    //-----------------------------------------------------
    public static function insertFuneralData(): array
    {
        $post = $_POST;
        $post[appDatabaseFuneral::primaryKey] = '';
        $dbPost = appLibraryDataformat::dbPostParam(appDatabaseFuneral::table, appDatabaseFuneral::primaryKey, $post);
        $sql = appLibraryEditsql::insertSql(self::setFuneralSqlConfig($dbPost));
        $param = appLibraryDataformat::bindParam($dbPost, appDatabaseFuneral::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
    //-----------------------------------------------------
    // 葬儀情報追加・更新＞葬儀情報を更新
    //-----------------------------------------------------
    public static function updateFuneralData(): array
    {
        $post = $_POST;
        $dbPost = appLibraryDataformat::dbPostParam(appDatabaseFuneral::table, appDatabaseFuneral::primaryKey, $post);
        $primaryKey = $dbPost[appDatabaseFuneral::primaryKey];
        $sql = appLibraryEditsql::updateSql(self::setFuneralSqlConfig($dbPost));
        $sql .= ' WHERE ';
        $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
        $param = appLibraryDataformat::bindParam($dbPost, appDatabaseFuneral::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
    //-----------------------------------------------------
    // 葬儀情報追加・更新＞SQL用を作成
    //-----------------------------------------------------
    public static function setFuneralSqlConfig($post): array
    {
        return ['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post];
    }


    //======================================================================
    // 顧客情報追加／更新
    //======================================================================
    public static function updateFuneralClientData(): array
    {
        $post = $_POST;
        $table = appDatabaseFuneralclient::table;
        $primaryKey = appDatabaseFuneralclient::primaryKey;
        $result = [];
        if (!isset($post[$primaryKey])) {
            /*分岐：顧客情報なし*/
            return $result;
        }
        $count = 0;
        $dbPosts = appLibraryDataformat::dbPostMultiple($post, $primaryKey);
        foreach ($dbPosts as $dbPost) {
            $dbPost = appLibraryDataformat::dbPostParam($table, $primaryKey, $dbPost);
            $sql = self::createUpdateFuneralClientSql($dbPost);
            $param = appLibraryDataformat::bindParam($dbPost, $table);
            $result = appFuncDatabase::updateData($sql, $param);
            $count++;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 顧客情報追加／更新＞SQLを作成
    //-----------------------------------------------------
    public static function createUpdateFuneralClientSql($dbpost): string
    {
        $sql = "";
        $postPrimaryKey = $dbpost[appDatabaseFuneralclient::primaryKey];
        $sqlConfig = ['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table, 'dbPost' => $dbpost];
        if ($postPrimaryKey != '') {
            /*分岐1：既存顧客*/
            $sql = appLibraryEditsql::updateSql($sqlConfig);
            $sql .= ' WHERE ' . appDatabaseFuneralclient::primaryKey . '=' . $postPrimaryKey;
        } else {
            /*分岐2：新規顧客*/
            $sql = appLibraryEditsql::insertSql($sqlConfig);
        }
        return $sql;
    }

    //======================================================================
    // コンテナ+レポート（顧客対応）追加／更新
    //======================================================================
    public static function updateContainerCs(): array
    {
        $result = [];
        $post = $_POST;
        $tableName = appDatabaseContainerCs::tableName;
        $table = appDatabaseContainerCs::table;
        $primaryKey = appDatabaseContainerCs::primaryKey;
        if (isset($post[$primaryKey])) {
            $dbpost = appLibraryDataformat::dbPostParam($table, $primaryKey, $post);
            $sqlConfig = ['tableName' => $tableName, 'table' => $table, 'dbPost' => $dbpost];
            if ($post[$primaryKey] != '') {
                /*分岐1：更新*/
                $sql = appLibraryEditsql::updateSql($sqlConfig);
                $sql .= ' WHERE ' . $primaryKey . '=' . $post[$primaryKey];
                $param = appLibraryDataformat::bindParam($dbpost, $table);
                $result = appFuncDatabase::updateData($sql, $param);
            } else {
                /*分岐2：新規*/
                $sql = appLibraryEditsql::insertSql($sqlConfig);
                $param = appLibraryDataformat::bindParam($dbpost, $table);
                $result = appFuncDatabase::updateData($sql, $param);
                $post[$primaryKey] = $result[appFuncDatabase::updateDataLastInsertId];
            }
            if (isset($post[appDatabaseReport::categoryRow])) {
                $result = self::updateReport($post);
            }
        }
        return $result;
    }

    //======================================================================
    // レポート追加／更新
    //======================================================================
    //-----------------------------------------------------
    // レポートを追加／更新(複数)
    //-----------------------------------------------------
    public static function updateReports(): array
    {
        $post = $_POST;
        $result = appFuncDatabase::updateDataResults;
        $dbPosts = appLibraryDataformat::dbPostMultiple($post, appDatabaseReport::primaryKey);
        foreach ($dbPosts as $index => $dbPost) {
            $result = self::updateReport($dbPost);
            if ($result[appFuncDatabase::updateDataBool] === false) {
                break;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // レポートを追加／更新
    //-----------------------------------------------------
    public static function updateReport($post): array
    {
        $parentDbResult = self::updateParentReport($post);
        if ($parentDbResult[appFuncDatabase::updateDataBool] === true) {
            $childDbResult = self::updateChildReport($post, $parentDbResult);
        } else {
            return $parentDbResult;
        }
        return $childDbResult;
    }
    //-----------------------------------------------------
    // レポートを追加／更新＞親テーブル
    //-----------------------------------------------------
    public static function updateParentReport($post): array
    {
        $dbpost = appLibraryDataformat::dbPostParam(appDatabaseReport::table, appDatabaseReport::primaryKey, $post);
        $sql = self::updateParentReportSql($dbpost);
        $param = appLibraryDataformat::bindParam($dbpost, appDatabaseReport::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
    //-----------------------------------------------------
    // レポートを追加／更新＞親テーブル＞SQL作成
    //-----------------------------------------------------
    public static function updateParentReportSql($dbPost): string
    {
        $sql = "";
        $sqlConfig = ['tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table, 'dbPost' => $dbPost];
        $postPrimaryKey = appFuncArray::issetKey($dbPost, appDatabaseReport::primaryKey, '');
        if ($postPrimaryKey != '') {
            /*分岐1：既存*/
            $sql = appLibraryEditsql::updateSql($sqlConfig);
            $sql .= ' WHERE ' . appDatabaseReport::primaryKey . '=' . $postPrimaryKey;
        } else {
            /*分岐2：新規*/
            $sql = appLibraryEditsql::insertSql($sqlConfig);
        }
        return $sql;
    }
    //-----------------------------------------------------
    // レポートを追加／更新＞子テーブル
    //-----------------------------------------------------
    public static function updateChildReport($post, $parentDbResult): array
    {
        $result = appFuncDatabase::updateDataResults;
        $reportCategory = $post[appDatabaseReport::categoryRow];
        list($tableName, $table) = self::selectReportTable($reportCategory);
        $dbpost = appLibraryDataformat::dbPostParam($table, appDatabaseReport::primaryKey, $post);
        $insertReportId = $parentDbResult[appFuncDatabase::updateDataLastInsertId];
        if ($insertReportId != '') {
            /*分岐：新規*/
            $dbpost[appDatabaseReport::primaryKey] = $insertReportId;
        }
        $sql = self::updateChildReportSql($dbpost, $tableName, $table, $insertReportId);
        $param = appLibraryDataformat::bindParam($dbpost, $table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
    //-----------------------------------------------------
    // レポートを追加／更新＞子テーブル＞SQLを作成
    //-----------------------------------------------------
    public static function updateChildReportSql($dbpost, $tableName, $table, $insertReportId): string
    {
        $sql = "";
        $sqlConfig = ['tableName' => $tableName, 'table' => $table, 'dbPost' => $dbpost];
        if ($insertReportId != '') {
            /*分岐1：新規*/
            $sql = appLibraryEditsql::insertSql($sqlConfig);
        } else {
            /*分岐2：既存*/
            $sql = appLibraryEditsql::updateSql($sqlConfig);
        }
        return $sql;
    }
    //-----------------------------------------------------
    // レポートを追加／更新＞子テーブル＞データベース選択
    //-----------------------------------------------------
    public static function selectReportTable($reportCategory): array
    {
        switch ($reportCategory) {
            case appDatabaseReport::categoryCs:
                /*分岐1：顧客対応*/
                $tableName = appDatabaseReport::categoryCs;
                $table = appDatabaseReport::tableCs;
                break;
            case appDatabaseReport::categoryTel:
                /*分岐2：課電*/
                $tableName = appDatabaseReport::categoryTel;
                $table = appDatabaseReport::tableTel;
                break;
            default:
                /*分岐3：該当なし*/
                $tableName = "";
                $table = [];
                break;
        }
        $result = [
            $tableName,
            $table
        ];
        return $result;
    }
}
