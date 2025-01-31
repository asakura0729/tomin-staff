<?php
//======================================================================
// CRM＞データ送信
//======================================================================
trait appLibraryCrmPost
{

    //======================================================================
    // 汎用
    //======================================================================
    //-----------------------------------------------------
    // データベースに追加するValue値を設定
    //-----------------------------------------------------
    public static function createDbPost($table, $post, $count = null): array
    {
        $dbpost = [];
        foreach ($table as $row) {
            $inputName = $row[appConfigDatabase::row];
            if (isset($post[$inputName])) {
                if ($count === null) {
                    $dbpost[$inputName] = $post[$inputName];
                } else {
                    $dbpost[$inputName] = $post[$inputName][$count];
                }
            }
        }
        return $dbpost;
    }

    //======================================================================
    // 葬儀情報追加・更新
    //======================================================================
    //-----------------------------------------------------
    // 葬儀情報追加・更新＞更新対象の葬儀IDを取得
    //-----------------------------------------------------
    public static function getFuneralId(): array
    {
        $result[appDatabaseFuneral::primaryKey] = "";
        if (isset($_POST[appDatabaseFuneral::primaryKey])) {
            if ($_POST[appDatabaseFuneral::primaryKey] != '') {
                /*分岐1：更新*/
                $result[appDatabaseFuneral::primaryKey] = $_POST[appDatabaseFuneral::primaryKey];
            } else {
                /*分岐2：新規*/
                $dbresult = self::insertFuneralData();
                $sql = appLibraryEditsql::getInsertID();
                $dbresult = appFuncDatabase::getData($sql);
                $result[appDatabaseFuneral::primaryKey] = $dbresult[0];
            }
        }
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞SQL用を作成
    //-----------------------------------------------------
    public static function setFuneralSqlConfig($post): array
    {
        return ['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post];
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞葬儀情報を追加
    //-----------------------------------------------------
    public static function insertFuneralData(): array
    {
        $post = $_POST;
        $post = self::insertDataFormat($post);
        $sql = appLibraryEditsql::insertSql(self::setFuneralSqlConfig($post));
        $param = appLibraryDataformat::dbPost($post, appDatabaseFuneral::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞葬儀情報を更新
    //-----------------------------------------------------
    public static function updateFuneralData(): array
    {
        $post = self::updateDataFormat($_POST);
        $primaryKey = $post[appDatabaseFuneral::primaryKey];
        $sql = appLibraryEditsql::updateSql(self::setFuneralSqlConfig($post));
        $sql .= ' WHERE ';
        $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
        $param = appLibraryDataformat::dbPost($post, appDatabaseFuneral::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞データ整形（葬儀情報追加）
    //-----------------------------------------------------
    public static function insertDataFormat($post): array
    {
        $post['insert_date'] = date('Y-m-d H:i:s');
        $post['insert_by'] = 0;
        return $post;
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞データ整形（葬儀情報更新）
    //-----------------------------------------------------
    public static function updateDataFormat($post): array
    {
        if (isset($post['funeral_date'])) {
            $funeral_date = new DateTime($post['funeral_date']);
            $post['funeral_date'] =  $funeral_date->format('Y-m-d');
        }
        if (isset($post['totalpeople'])) {
            $post['totalpeople'] = intval($post['totalpeople']);
        }
        $post['update_date'] = date('Y-m-d H:i:s');
        $post['update_by'] = 0;

        return $post;
    }

    //======================================================================
    // 顧客情報追加／更新
    //======================================================================
    public static function updateFuneralClientData(): array
    {
        $post = $_POST;
        $result = [];
        if (!isset($post[appDatabaseFuneralclient::primaryKey])) {
            /*分岐：顧客情報なし*/
            return $result;
        }
        $count = 0;
        foreach ($post[appDatabaseFuneralclient::primaryKey] as $index => $postPrimaryKey) {
            $dbpost = self::createDbPost(appDatabaseFuneralclient::table, $post, $count);
            $sql = self::createUpdateFuneralClientSql($postPrimaryKey, $dbpost);
            $param = appLibraryDataformat::dbPost($dbpost, appDatabaseFuneralclient::table);
            $result = appFuncDatabase::updateData($sql, $param);
            $count++;
        }
        return $result;
    }

    //-----------------------------------------------------
    // 顧客情報追加／更新＞SQLを作成
    //-----------------------------------------------------
    public static function createUpdateFuneralClientSql($postPrimaryKey, $dbpost): string
    {
        $sql = "";
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
    // レポート追加／更新
    //======================================================================
    //-----------------------------------------------------
    // レポートを追加／更新
    //-----------------------------------------------------
    public static function updateReport(): array
    {
        $post = $_POST;
        if (!isset($post[appDatabaseReport::primaryKey])) {
            /*分岐：レポートなし*/
            return appFuncDatabase::updateDataResults;
        }
        $count = 0;
        foreach ($post[appDatabaseReport::primaryKey] as $index => $postPrimaryKey) {
            $parentDbResult = self::updateParentReport($postPrimaryKey, $post, $count);
            if ($parentDbResult[appFuncDatabase::updateDataBool] === true) {
                $childDbResult = self::updateChildReport($postPrimaryKey, $post, $count, $parentDbResult);
                $count++;
            } else {
                break;
            }
        }
        return $childDbResult;
    }

    //-----------------------------------------------------
    // レポートを追加／更新＞親テーブル
    //-----------------------------------------------------
    public static function updateParentReport($postPrimaryKey, $post, $count): array
    {
        $dbpost = self::createDbPost(appDatabaseReport::table, $post, $count);
        $sql = self::updateParentReportSql($postPrimaryKey, $dbpost);
        $param = appLibraryDataformat::dbPost($dbpost, appDatabaseReport::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }

    //-----------------------------------------------------
    // レポートを追加／更新＞親テーブル＞SQL作成
    //-----------------------------------------------------
    public static function updateParentReportSql($postPrimaryKey, $dbpost): string
    {
        $sql = "";
        $sqlConfig = ['tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table, 'dbPost' => $dbpost];
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
    public static function updateChildReport($postPrimaryKey, $post, $count, $parentDbResult): array
    {
        if (!isset($post[appDatabaseReport::categoryRow]) || !isset($post[appDatabaseReport::categoryRow][$count])) {
            /*分岐：データなし*/
            return appFuncDatabase::updateDataResults;
        }
        list($tableName, $table) = self::selectReportTable($post[appDatabaseReport::categoryRow][$count]);
        $dbpost = self::createDbPost($table, $post, $count);
        if ($postPrimaryKey === '') {
            /*分岐：新規の場合、親テーブルのIDを継承*/
            $dbpost[appDatabaseReport::primaryKey] = $parentDbResult[appFuncDatabase::updateDataLastInsertId];
        }
        $sql = self::updateChildReportSql($postPrimaryKey, $dbpost, $tableName, $table);
        $param = appLibraryDataformat::dbPost($dbpost, $table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }

    //-----------------------------------------------------
    // レポートを追加／更新＞子テーブル＞SQLを作成
    //-----------------------------------------------------
    public static function updateChildReportSql($postPrimaryKey, $dbpost, $tableName, $table): string
    {
        $sql = "";
        $sqlConfig = ['tableName' => $tableName, 'table' => $table, 'dbPost' => $dbpost];
        if ($postPrimaryKey != '') {
            /*分岐1：既存*/
            $sql = appLibraryEditsql::updateSql($sqlConfig);
        } else {
            /*分岐2：新規追加*/
            $sql = appLibraryEditsql::insertSql($sqlConfig);
        }
        return $sql;
    }

    //-----------------------------------------------------
    // レポートを追加／更新＞データベース選択
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
                $table = "";
                break;
        }
        $result = [
            $tableName,
            $table
        ];
        return $result;
    }
}
