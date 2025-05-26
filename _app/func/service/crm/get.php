<?php
//======================================================================
// CRM＞データ受信
//======================================================================
class appFuncCrmGet
{
    //======================================================================
    // パラメータ
    //======================================================================
    public const tableName = appDatabaseCs::tableName; //テーブル名
    public const primaryKey = appDatabaseCs::primaryKey; //主キー
    public const alias = 'cs_sheet';  //結合テーブルエイリアス名
    //-----------------------------------------------------
    // GETパラメータ（対応ログ編集画面 + 送客シート編集画面）
    //-----------------------------------------------------
    public const getPrimaryKey = appDatabaseCs::primaryKey; //主キー
    //-----------------------------------------------------
    // GETパラメータ（対応ログ編集画面）
    //-----------------------------------------------------
    public const getCloneFlg = 'clone'; //複製フラグ
    public const getTel = 'tel'; //電話番号
    public const getDate = 'date'; //日付
    public const getOverwriteSheetFlg = 'overwrite_sheet'; //上書きフラグ（対応ログの一部を送客シートの内容に書き換える）
    //-----------------------------------------------------
    // GETパラメータ（一覧画面）
    //-----------------------------------------------------
    public const getClientCategoryFilter = 'client_category_filter'; //有効・無効電話のフィルタリング

    //======================================================================
    // SQL作成
    //======================================================================
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
    // SQL作成＞JOIN句作成
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
    // SQL作成＞Where句＞有効・無効電話のフィルタリング
    //-----------------------------------------------------
    public static function whereClienCategory($get, $tableName, $result = ""): string
    {
        if (isset($get[self::getClientCategoryFilter])) {
            $filterparam = $get[self::getClientCategoryFilter];
            $array = appConfigStatus::clientCategory;
            $result .= "AND(";
            foreach ($array as $key => $value) {
                if ($value['type'] == $filterparam) {
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

    //======================================================================
    // データ取得
    //======================================================================
    //-----------------------------------------------------
    // データ取得
    //-----------------------------------------------------
    public static function getData(array $get = [], int $colCount = 1): array
    {
        $sql = self::sqlSelectFrom($get);
        $sql .= appFuncSql::orderBy(self::tableName, self::primaryKey);
        $sql .= appFuncSql::limit($colCount);
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
            $dbresult = self::getData([self::primaryKey => $primaryKey, 'cs_category' => $cs_category]);
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
    public static function getDataIndex(array $get = [], int $colCount = appConfigDatabase::pageColCount): array
    {
        $result = [];
        $dbresult = self::getData($get, $colCount);
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
    // データ取得(複数＞総数)
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
            /*分岐：データが存在*/
            $result = $dbresult[0]['count'];
        }
        return $result;
    }

    //======================================================================
    // 固有ページの挙動
    //======================================================================
    //-----------------------------------------------------
    // 一覧画面＞表示する列の選定
    //-----------------------------------------------------
    public static function selectRow(string $path): array
    {
        $result = [];
        switch ($path) {
            case appRoutesWeb::sitemap['adminCsIndex']['contents']:
            case appRoutesWeb::sitemap['adminCsEdit']['contents']:
            case appRoutesWeb::sitemap['adminCsList_check']['contents']:
                /*分岐1：通常*/
                $result = appFuncCrmArray::list();
                break;
            case appRoutesWeb::sitemap['adminCsList_invalid']['contents']:
                /*分岐2：無効電話一覧*/
                $result = appFuncCrmArray::invalidList();
                break;
            case appRoutesWeb::sitemap['adminCsSheet']['contents']:
                /*分岐3：送客シート*/
                $result = appFuncCrmArray::sheetList();
                break;
            default:
                /*分岐4：その他*/
                $result = appFuncCrmArray::list();
                break;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 対応ログ編集画面＞読込時の挙動
    //-----------------------------------------------------
    public static function csEdit(array $get, string $postPrimaryKey = '', bool $dataformat = false): array
    {
        $result = [];
        $getPrimaryKey = appFuncArray::issetKey($get, self::getPrimaryKey, '');
        $table = array_merge(appDatabaseCs::tableCsList, appDatabaseCs::tableCsListJoin);
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
        return self::csEditDataformat($get, $result, $table, $dataformat);
    }
    //-----------------------------------------------------
    // 対応ログ編集画面＞読込時の挙動＞データ整形
    //-----------------------------------------------------
    public static function csEditDataformat(array $get, array $result, array $table, bool $dataFormat = false): array
    {
        if ($dataFormat === true) {
            /*分岐：取得したデータのフォーマット指定あり*/
            $result = appFuncDataformat::dbResultStr($result, $table);
        }
        if ($result[self::primaryKey] === '') {
            /*分岐1：新規データ...デフォルト値設定*/
            $getDate = appFuncDate::dateFormat(appFuncArray::issetKey($get,  self::getDate));
            $getTel = appFuncArray::issetKey($get, self::getTel);
            $result['post_date'] = $getDate;
            $result['client_tel'] = $getTel;
            $result['cs_category'] = appConfigStatus::csCategoryLog;
            $result['delivery_status'] = appConfigStatus::delivery_status['unnecessary']['key'];
            if (appFuncSession::checkAuth(appConfigUser::authorityManager) === true) {
                /*分岐1-1：権限：管理者*/
                $result['approval_status'] = appConfigStatus::approval_status['complete']['key'];
                $result['approval_by'] = $_SESSION[appConfigSession::userId];
            } else {
                /*分岐1-2：権限：その他*/
                $result['approval_status'] = appConfigStatus::approval_status['progress']['key'];
            }
        } else {
            /*分岐2：既存データ*/
            $getCloneFlg = appFuncArray::issetKey($get, self::getCloneFlg, '') == 'true'  ? true : false;
            $getOverwriteSheetFlg = appFuncArray::issetKey($get, self::getOverwriteSheetFlg, '') == 'true'  ? true : false;
            if ($getCloneFlg === true) {
                /*分岐2-1：複製フラグあり...新規データとして扱う*/
                $result[self::primaryKey] = '';
                $result['post_by'] = '';
                $result['approval_status'] = appConfigStatus::approval_status['progress']['key'];
            } else if ($getOverwriteSheetFlg === true) {
                /*分岐2-2：上書きフラグあり...データ一部を送客シートの内容に書き換え*/
                $result['client_name'] = $result['sheet_client_name'];
                $result['client_tel'] = $result['sheet_client_tel'];
                $result['dec_name'] = $result['sheet_dec_name'];
                $result['dec_relation'] = $result['sheet_dec_relation'];
                $result['funeral_company_name'] = $result['sheet_funeral_company_name'];
                $result['funeral_date'] = $result['sheet_funeral_date'];
                $result['hall_name'] = $result['sheet_hall_name'];
                $result['dec_region'] = $result['sheet_dec_region'];
                $result['crematory_name'] = $result['sheet_crematory_name'];
                $result['ensconce_category'] = $result['sheet_ensconce_category'];
                $result['dest_address'] = $result['sheet_dest_address'];
                $result['plan_category'] = $result['sheet_plan_category'];
                $result['option_name'] = $result['sheet_option_name'];
                $result['comment_sheet'] = $result['sheet_comment_sheet'];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 送客シート編集画面＞読込時の挙動
    //-----------------------------------------------------
    public static function csSheet(array $get, string $postPrimaryKey = '', bool $dataformat = false, $categoryFilter = true): array
    {
        $csCategory = "";
        if ($categoryFilter === true) {
            /*判断：カテゴリは「送客シート」以外許可しない*/
            $csCategory = appConfigStatus::csCategorySheet;
        }
        $table = appDatabaseCs::tableCsList;
        $getPrimaryKey = appFuncArray::issetKey($get, self::getPrimaryKey, '');
        if ($postPrimaryKey != '') {
            /*分岐1-1：既存データ参照...データ送信処理が実行された*/
            $result = self::getDataSingle($table, $postPrimaryKey, $csCategory);
        } else if ($getPrimaryKey != '') {
            /*分岐1-2：既存データ参照...クエリパラメータにcs_idあり*/
            $result = self::getDataSingle($table, $getPrimaryKey, $csCategory);
        } else {
            /*分岐1-3：新規データ*/
            $result = [];
        }
        if (isset($result['cs_category']) && $result['cs_category'] === appConfigStatus::csCategoryLog) {
            /*分岐2：既存データ参照 + カテゴリは対応ログ */
            $sheet_cs_id = appFuncArray::issetKey($result, 'sheet_cs_id', '');
            if ($sheet_cs_id != '') {
                /*分岐2-1：当該データは送客シートを作成済*/
                appFuncModule::component('nodata', ['css' => 'text-center', 'title' => '送客シートは作成済です']);
                exit;
            }
        }
        if ($result === []) {
            /*分岐3：新規データ or 既存データ参照したがデータが無い*/
            appFuncModule::component('nodata', ['css' => 'text-center']);
            exit;
        }
        return self::csSheetDataformat($result, $table, $dataformat);
    }
    //-----------------------------------------------------
    // 送客シート編集画面＞読込時の挙動＞データ整形
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
            $result['approval_status'] = appConfigStatus::approval_status['progress']['key'];
            $result['funeral_date'] = '';
            $result['hall_name'] =  '';
            $result['crematory_name'] = '';
            $result['ensconce_category'] =  '';
            $result['dest_address'] =  '';
            $result['option_name'] = '';
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
    //  /tpadmin/cs/count_cs　または　/tpadmin/cs/count_cs_sheet 読込時の挙動
    //-----------------------------------------------------
    public static function countApproval(string $cs_category): int
    {
        $count = appFuncCrmGet::count([
            'cs_category' => $cs_category,
            'approval_status' => appConfigStatus::approval_status['progress']['key']
        ]);
        return $count;
    }
}
