<?php
//======================================================================
// CRM
//======================================================================
class appLibraryCrm
{

    //-----------------------------------------------------
    // 使用するパラメータ
    //-----------------------------------------------------
    const postConfirm = 'confirm';
    const confirmFuneralId = 'funeral_id';
    const confirmFuneralData = 'funeral';
    const confirmFuneralClientData = 'funeral_client';
    const confirmReport = 'report';

    //======================================================================
    // データ取得
    //======================================================================
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
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table]
        );
        $sql .= ' WHERE ';
        $sql .= appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '"';
        $result = appFuncDatabase::getData($sql);
        foreach ($result as $index => $value) {
            $result[$index] = appLibraryDataformat::dbResult($value, appDatabaseFuneralclient::table);
        }
        return $result;
    }

    //-----------------------------------------------------
    // レポートを取得
    //-----------------------------------------------------
    public static function getReport($category, $table = [], $report_id = "")
    {
        $primaryKey = appFuncArray::issetKey($_GET, appDatabaseFuneral::primaryKey, '');
        $reportId = appFuncArray::issetKey($_GET, appDatabaseReport::primaryKey, '');
        $sql = appLibraryEditsql::requestSql(
            ['tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table],
            ['primaryKey' => appDatabaseReport::primaryKey, 'tableName' => $category, 'table' => $table]
        );
        $sql .= ' WHERE ';
        $sql .= $category . '.' . appDatabaseFuneral::primaryKey . '="' .  $primaryKey . '" and ';
        $sql .= 'report_category="' .  $category . '" ';
        if ($reportId != '') {
            $sql .= ' and ' . appDatabaseReport::tableName . '.' . appDatabaseReport::primaryKey . '="' .  $reportId . '" ';
        }
        $result = appFuncDatabase::getData($sql);
        return $result;
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
                self::insertFuneralData();
                $result[appDatabaseFuneral::primaryKey] = appLibraryEditsql::getLatest(
                    appDatabaseFuneral::tableName,
                    appDatabaseFuneral::table,
                    appDatabaseFuneral::primaryKey
                );
            }
        }
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞葬儀情報を追加
    //-----------------------------------------------------
    public static function insertFuneralData(): bool
    {
        $post = $_POST;
        $post = self::insertDataFormat($post);
        $sql = appLibraryEditsql::insertSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post]);
        $param = appLibraryDataformat::dbPost($post, appDatabaseFuneral::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }

    //-----------------------------------------------------
    // 葬儀情報追加・更新＞葬儀情報を更新
    //-----------------------------------------------------
    public static function updateFuneralData(): bool
    {
        $post = self::updateDataFormat($_POST);
        $primaryKey = $post[appDatabaseFuneral::primaryKey];
        $sql = appLibraryEditsql::updateSql(['tableName' => appDatabaseFuneral::tableName, 'table' => appDatabaseFuneral::table, 'dbPost' => $post]);
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
    // 顧客情報追加・更新
    //======================================================================
    //-----------------------------------------------------
    // 顧客情報を追加／更新
    //-----------------------------------------------------
    public static function updateFuneralClientData(): bool
    {
        $post = $_POST;
        $result = true;
        if (!isset($post[appDatabaseFuneralclient::primaryKey])) {
            /*分岐：顧客情報なし*/
            return $result;
        }
        $count = 0;
        foreach ($post[appDatabaseFuneralclient::primaryKey] as $index => $postPrimaryKey) {
            $dbpost = [];
            foreach (appDatabaseFuneralclient::table as $row) {
                $inputName = $row[appDatabaseFuneralclient::row];
                if (isset($post[$inputName])) {
                    $dbpost[$inputName] = $post[$inputName][$count];
                }
            }
            $sqlConfig = ['tableName' => appDatabaseFuneralclient::tableName, 'table' => appDatabaseFuneralclient::table, 'dbPost' => $dbpost];
            if ($postPrimaryKey != '') {
                /*分岐1：既存顧客*/
                $sql = appLibraryEditsql::updateSql($sqlConfig);
                $sql .= ' WHERE ' . appDatabaseFuneralclient::primaryKey . '=' . $postPrimaryKey;
            } else {
                /*分岐2：新規顧客*/
                $sql = appLibraryEditsql::insertSql($sqlConfig);
            }
            $param = appLibraryDataformat::dbPost($dbpost, appDatabaseFuneralclient::table);
            $result = appFuncDatabase::updateData($sql, $param);
            $count++;
        }
        return $result;
    }

    //======================================================================
    // レポート追加・更新
    //======================================================================
    //-----------------------------------------------------
    // レポートを追加／更新
    //-----------------------------------------------------
    public static function updateReport(): bool
    {
        $post = $_POST;
        $result = true;
        if (!isset($post[appDatabaseReport::primaryKey])) {
            /*分岐：レポートなし*/
            return $result;
        }
        $count = 0;
        foreach ($post[appDatabaseReport::primaryKey] as $index => $postPrimaryKey) {
            $result = self::updateReportBase($postPrimaryKey, $post, $count);
            if ($result === true) {
                $result = self::updateJoinReport($postPrimaryKey, $post, $count);
            }
            $count++;
        }
        return $result;
    }
    //-----------------------------------------------------
    // レポート用の配列を作成
    //-----------------------------------------------------
    public static function editDbPost($table, $post, $count): array
    {
        $result = [];
        foreach ($table as $row) {
            $inputName = $row[appDatabaseReport::row];
            if (isset($post[$inputName])) {
                $result[$inputName] = $post[$inputName][$count];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // レポートを追加／更新(基本)
    //-----------------------------------------------------
    public static function updateReportBase($postPrimaryKey, $post, $count): bool
    {
        $dbpost = self::editDbPost(appDatabaseReport::table, $post, $count);
        $dbpost = self::insertDataFormat($dbpost);
        $sqlConfig = ['tableName' => appDatabaseReport::tableName, 'table' => appDatabaseReport::table, 'dbPost' => $dbpost];
        if ($postPrimaryKey != '') {
            /*分岐1：既存*/
            $sql = appLibraryEditsql::updateSql($sqlConfig);
            $sql .= ' WHERE ' . appDatabaseReport::primaryKey . '=' . $postPrimaryKey;
        } else {
            /*分岐2：新規*/
            $sql = appLibraryEditsql::insertSql($sqlConfig);
        }
        $param = appLibraryDataformat::dbPost($dbpost, appDatabaseReport::table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
    //-----------------------------------------------------
    // レポートを追加／更新(JOIN)
    //-----------------------------------------------------
    public static function updateJoinReport($postPrimaryKey, $post, $count): bool
    {
        $result = true;
        $reportCategory = "";
        if (isset($post['report_category'])) {
            /*分岐：レポートのカテゴリを取得*/
            $reportCategory = appFuncArray::issetKey($post['report_category'], $count, '');
        }
        switch ($reportCategory) {
            case appDatabaseReport::categoryCs:
                /*分岐1：顧客対応*/
                $table = appDatabaseReport::tableCs;
                $tableName = appDatabaseReport::categoryCs;
                break;
            case appDatabaseReport::categoryTel:
                /*分岐2：課電*/
                $table = appDatabaseReport::tableTel;
                $tableName = appDatabaseReport::categoryTel;
                break;
            case appDatabaseReport::categoryApproval:
                /*分岐3：承認*/
                $table = appDatabaseReport::tableApproval;
                $tableName = appDatabaseReport::categoryApproval;
                break;
            default:
                return $result;
                break;
        }
        $dbpost = self::editDbPost($table, $post, $count);
        if ($postPrimaryKey != '') {
            /*分岐1：既存*/
            $sqlConfig = ['tableName' => $tableName, 'table' => $table, 'dbPost' => $dbpost];
            $sql = appLibraryEditsql::updateSql($sqlConfig);
            $sql .= ' WHERE ' . appDatabaseReport::primaryKey . '=' . $postPrimaryKey;
        } else {
            /*分岐2：新規*/
            $dbpost[appDatabaseReport::primaryKey] = appLibraryEditsql::getLatest(
                appDatabaseReport::tableName,
                appDatabaseReport::table,
                appDatabaseReport::primaryKey
            );
            $sqlConfig = ['tableName' => $tableName, 'table' => $table, 'dbPost' => $dbpost];
            $sql = appLibraryEditsql::insertSql($sqlConfig);
        }
        $param = appLibraryDataformat::dbPost($dbpost, $table);
        $result = appFuncDatabase::updateData($sql, $param);
        return $result;
    }
}
