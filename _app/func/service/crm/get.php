<?php
//======================================================================
// CRM＞データ受信
//======================================================================
class appFuncCrmGet
{
    public const dbClass = appDatabaseCs::className;
    public const tableName = appDatabaseCs::tableName;
    public const primaryKey = appDatabaseCs::primaryKey;
    public const db = appDatabaseCs::table;
    public const alias = 'cs_sheet';
    //-----------------------------------------------------
    // SQL作成
    //-----------------------------------------------------
    public static function sqlSelectFrom(array $get = []): string
    {
        $select = appFuncSql::select(self::tableName, appDatabaseCs::tableCsList);
        $select = appFuncSql::select(self::alias, appDatabaseCs::tableCsListJoin, $select);
        $select = appFuncSql::from(self::tableName, $select);
        $select = self::sqlJoin($select, self::alias);
        $where = appFuncSql::where(self::tableName, appDatabaseCs::tableCsList, $get);
        $where = appFuncSql::where(self::alias, appDatabaseCs::tableCsListJoin, $get, $where);
        $where = self::whereClienCategory($get, self::tableName, $where);
        $sql = $select . $where;
        return $sql;
    }
    //-----------------------------------------------------
    // SQL作成＞JOIN
    //-----------------------------------------------------
    public static function sqlJoin($select, $alias): string
    {
        $select = appFuncSql::join([
            'parent' => self::tableName,
            'child' => self::tableName,
            'childAlias' => $alias,
            'parentKey' => self::primaryKey,
            'childKey' => 'parent_cs_id'
        ], $select);
        return $select;
    }
    //-----------------------------------------------------
    // SQL作成＞無効電話のフィルタリング
    //-----------------------------------------------------
    public static function whereClienCategory($get, $tableName, $result = ""): string
    {
        if (isset($get['client_category_filter'])) {
            $filterparam = $get['client_category_filter'];
            $array = appConfigStatus::clientCategory;
            $result .= "AND(";
            foreach ($array as $key => $value) {
                if ($value['type'] == $filterparam) {
                    /*分岐：無効電話*/
                    $result .= $tableName . '.client_category="' . $key . '" ';
                    if ($value != end($array)) {
                        $result .= 'OR ';
                    }
                }
            }
            $result .= ")";
        }
        return $result;
    }
    //-----------------------------------------------------
    // データ取得
    //-----------------------------------------------------
    public static function getData(array $get = [], array $table = []): array
    {
        $sql = self::sqlSelectFrom($get, $table);
        $sql .= appFuncSql::orderBy(self::tableName, self::primaryKey);
        $sql .= appFuncSql::limit();
        $result = appFuncDatabase::getData($sql);
        return $result;
    }
    //-----------------------------------------------------
    // データ取得(個別)
    //-----------------------------------------------------
    public static function getDataSingle(array $table, string $primaryKey = '', string $cs_category = ''): array
    {
        if ($primaryKey != '') {
            /*分岐1：cs_id指定あり*/
            $dbresult = self::getData([self::primaryKey => $primaryKey, 'cs_category' => $cs_category], $table);
            if (count($dbresult) > 0) {
                /*分岐1-1：既存*/
                $result = appFuncDataformat::dbResult($dbresult[0], $table);
            } else {
                /*分岐1-2：存在しないデータ*/
                $result = [];
            }
        } else {
            /*分岐2：新規*/
            $result = appFuncDataformat::dbResult([], $table);
        }
        return $result;
    }
    //-----------------------------------------------------
    // データ取得(複数)
    //-----------------------------------------------------
    public static function getDataIndex(array $get = []): array
    {
        $result = [];
        $dbresult = self::getData($get);
        $table = array_merge(appDatabaseCs::tableCsList, appDatabaseCs::tableCsListJoin);
        if (count($dbresult) > 0) {
            foreach ($dbresult as $index => $value) {
                $result[$index] = appFuncDataformat::dbResultStr($value, $table);
                $result[$index]['dbresult'] = $value;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // データ総数取得
    //-----------------------------------------------------
    public static function count(array $get = []): string
    {
        $result = '0';
        $select = appFuncSql::getCount(self::tableName, self::primaryKey);
        $select = self::sqlJoin($select, self::alias);
        $where = appFuncSql::where(self::tableName, appDatabaseCs::tableCsList, $get);
        $where = appFuncSql::where(self::alias, appDatabaseCs::tableCsListJoin, $get, $where);
        $where = self::whereClienCategory($get, self::tableName, $where);
        $dbresult = appFuncDatabase::getData($select . $where);
        if (isset($dbresult[0]['count'])) {
            $result = $dbresult[0]['count'];
        }
        return $result;
    }
    //-----------------------------------------------------
    // /tpadmin/cs/edit 読込時の挙動
    //-----------------------------------------------------
    public static function csEdit(array $get, string $postPrimaryKey = '', bool $dataformat = false): array
    {
        $result = [];
        $table = array_merge(appDatabaseCs::tableCsList, appDatabaseCs::tableCsListJoin);
        $getPrimaryKey = appFuncArray::issetKey($get, appDatabaseCs::primaryKey, '');
        $csCategory = appConfigStatus::csCategoryLog;
        if ($postPrimaryKey != '') {
            /*分岐1：既存データ参照...データ送信処理が実行された*/
            $result = self::getDataSingle($table, $postPrimaryKey, $csCategory);
        } else if ($getPrimaryKey != '') {
            /*分岐2：既存データ参照...クエリパラメータにcs_idあり*/
            $result = self::getDataSingle($table, $getPrimaryKey, $csCategory);
        } else {
            /*分岐3：新規データ：クエリパラメータにcs_idなし*/
            $result = self::getDataSingle($table);
        }
        if ($result === []) {
            /*分岐4：データが存在しない*/
            appFuncModule::component('nodata', ['css' => 'text-center']);
            exit;
        }
        $result = self::csEditDataformat($get, $result, $table, $dataformat);
        return $result;
    }
    //-----------------------------------------------------
    // /tpadmin/cs/edit 読込時の挙動＞データフォーマット
    //-----------------------------------------------------
    public static function csEditDataformat(array $get, array $result, array $table, bool $dataFormat = false): array
    {
        if ($dataFormat === true) {
            /*分岐：取得したデータのフォーマット指定あり*/
            $result = appFuncDataformat::dbResultStr($result, $table);
        }
        if ($result[self::primaryKey] === '') {
            /*分岐1：新規*/
            $result['post_date'] = appFuncDate::dateFormat(appFuncArray::issetKey($get, 'date'));
            $result['client_tel'] = appFuncArray::issetKey($get, 'tel');
            $result['post_by'] = $_SESSION[appConfigSession::userId];
            $result['cs_category'] = appConfigStatus::csCategoryLog;
            $result['delivery_status'] = appConfigStatus::delivery_status['unnecessary']['key'];
            $result['client_category'] = appConfigStatus::clientCategory['other_invalid']['key'];
            $result['approval_status'] = appConfigStatus::approval_status['started']['key'];
        } else {
            /*分岐2：既存*/
            $getCloneFlg = appFuncArray::issetKey($get, 'clone', '') == 'true'  ? true : false;
            if ($getCloneFlg === true) {
                /*分岐2-1：複製フラグあり*/
                $result[self::primaryKey] = '';
                $result['post_by'] = $_SESSION[appConfigSession::userId];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // /tpadmin/cs/sheet 読込時の挙動
    //-----------------------------------------------------
    public static function csSheet(array $get, string $postPrimaryKey = '', bool $dataformat = false, $categoryFilter = true): array
    {
        $csCategory = "";
        if ($categoryFilter === true) {
            /*判断：カテゴリは「送客シート」以外許可しない*/
            $csCategory = appConfigStatus::csCategorySheet;
        }
        $table = appDatabaseCs::tableCsList;
        $getPrimaryKey = appFuncArray::issetKey($get, appDatabaseCs::primaryKey, '');
        if ($postPrimaryKey != '') {
            /*分岐1：既存データ参照...データ送信処理が実行された*/
            $result = self::getDataSingle($table, $postPrimaryKey, $csCategory);
        } else if ($getPrimaryKey != '') {
            /*分岐2：既存データ参照...クエリパラメータにcs_idあり*/
            $result = self::getDataSingle($table, $getPrimaryKey, $csCategory);
        } else {
            /*分岐3：新規データ*/
            $result = [];
        }
        if (isset($result['cs_category']) && $result['cs_category'] === appConfigStatus::csCategoryLog) {
            /*判断：カテゴリは対応ログ */
            $sheet_cs_id = appFuncArray::issetKey($result, 'sheet_cs_id', '');
            if ($sheet_cs_id != '') {
                /*分岐：送客シート作成済*/
                appFuncModule::component('nodata', ['css' => 'text-center', 'title' => '送客シートは作成済です']);
                exit;
            }
        }
        if ($result === []) {
            /*判断：データが存在しない*/
            appFuncModule::component('nodata', ['css' => 'text-center']);
            exit;
        }
        $result = self::csSheetDataformat($result, $table, $dataformat);
        return $result;
    }
    //-----------------------------------------------------
    // /tpadmin/cs/sheet 読込時の挙動＞データフォーマット
    //-----------------------------------------------------
    public static function csSheetDataformat(array $result, array $table, bool $dataformat = false): array
    {
        $result['client_tel'] = str_replace("①", "", $result['client_tel']);
        $result['client_tel'] = appFuncString::formatPhoneNumber($result['client_tel']);
        if (strpos($result['client_name'], "②") === false) {
            /*分岐：依頼者名が一行*/
            $result['client_name'] = str_replace("①", "", $result['client_name']);
        }
        if ($result['cs_category'] === appConfigStatus::csCategoryLog) {
            /*分岐：送客シート未作成*/
            $result[self::primaryKey] = '';
            $result['title'] = '送客シート';
            $result['parent_cs_id'] = $_GET[appDatabaseCs::primaryKey];
            $result['cs_category'] = appConfigStatus::csCategorySheet;
            $result['approval_status'] = appConfigStatus::approval_status['started']['key'];
            $result['comment'] = '';
        }
        if ($dataformat === true) {
            /*分岐：取得したデータのフォーマット指定あり*/
            $formatResult = appFuncDataformat::dbResultStr($result, $table);
            $formatResult['post_date']  = substr($formatResult['post_date'], 0, -6);
            $formatResult['approval_status'] =  $result['approval_status']; //【!】承認ステータスは生データを使用
            $result = $formatResult;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 未承認データ総数取得
    //-----------------------------------------------------
    public static function countApproval($cs_category): int
    {
        $count = appFuncCrmGet::count([
            'cs_category' => $cs_category,
            'approval_status' => appConfigStatus::approval_status['progress']['key']
        ]);
        return $count;
    }
}
