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
    //-----------------------------------------------------
    // データ取得
    //-----------------------------------------------------
    public static function getData(array $get = [], array $table = []): array
    {
        $sql = self::sql($get, $table);
        $sql .= appFuncSql::orderBy(self::tableName, self::primaryKey);
        $sql .= appFuncSql::limit();
        $result = appFuncDatabase::getData($sql);
        return $result;
    }
    //-----------------------------------------------------
    // SQL作成
    //-----------------------------------------------------
    public static function sql(array $get = []): string
    {
        $alias = 'cs_sheet';
        $sql = appFuncSql::select(self::tableName, appDatabaseCs::csList);
        $sql = appFuncSql::select($alias, appDatabaseCs::csListJoin, $sql);
        $sql = appFuncSql::from(self::tableName, $sql);
        $sql = appFuncSql::join([
            'parent' => self::tableName,
            'child' => self::tableName,
            'childAlias' => $alias,
            'parentKey' => self::primaryKey,
            'childKey' => 'cs_id',
        ], $sql);
        $sql .= appFuncSql::where(self::tableName, appDatabaseCs::csList, $get);
        return $sql;
    }
    //-----------------------------------------------------
    // マージしたテーブルを取得
    //-----------------------------------------------------
    public static function mergeTable(): array
    {
        $table = array_merge(appDatabaseCs::csList, appDatabaseCs::csListJoin);
        return $table;
    }
    //-----------------------------------------------------
    // データ取得(個別)
    //-----------------------------------------------------
    public static function getDataSingle(string $primaryKey = '', string $cs_category = '', bool $dataFormat = false): array
    {
        $table = array_merge(appDatabaseCs::csList, appDatabaseCs::csListJoin);
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
        if ($dataFormat === true) {
            /*判断：取得したデータのフォーマット指定あり*/
            $result = appFuncDataformat::dbResultStr($result, $table);
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
        $table = array_merge(appDatabaseCs::csList, appDatabaseCs::csListJoin);
        if (count($dbresult) > 0) {
            foreach ($dbresult as $index => $value) {
                $result[$index] = appFuncDataformat::dbResultStr($value, $table);
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // データ総数
    //-----------------------------------------------------
    public static function count(array $get = []): string
    {
        $result = '0';
        $sql = self::sql($get);
        $dbresult = appFuncDatabase::getData($sql);
        if (isset($dbresult[0]['count'])) {
            $result = $dbresult[0]['count'];
        }
        return $result;
    }
    //-----------------------------------------------------
    // /tpadmin/cs/edit 読込時の挙動
    //-----------------------------------------------------
    public static function tpadminCsAjax(array $get, string $postPrimaryKey = '', bool $dataformat = false): array
    {
        $getPrimaryKey = appFuncArray::issetKey($get, appDatabaseCs::primaryKey, '');
        $getCloneFlg = appFuncArray::issetKey($get, 'clone', '') == 'true'  ? true : false;
        $csCategory = appConfigStatus::csCategoryLog;
        if ($postPrimaryKey != '') {
            /*分岐1：既存データ参照...データ送信処理が実行された*/
            $result = self::getDataSingle($postPrimaryKey, $csCategory, $dataformat);
        } else if ($getPrimaryKey != '') {
            /*分岐2：既存データ参照...クエリパラメータにcs_idあり*/
            $result = appFuncCrmGet::getDataSingle($getPrimaryKey, $csCategory, $dataformat);
            if ($getCloneFlg === true) {
                /*分岐2-1：複製フラグが立っている場合、cs_idの値を初期化*/
                $result[self::primaryKey] = '';
            }
        } else {
            /*分岐3：新規データ：クエリパラメータにcs_idなし*/
            $result = appFuncCrmGet::getDataSingle();
            $result['post_date'] = date('Y-m-d H:i');
            $result['post_by'] = $_SESSION[appConfigSession::userId];
            $result['cs_category'] = appConfigStatus::csCategoryLog;
        }
        if ($result === []) {
            /*分岐4：データが存在しない*/
            appFuncModule::component('nodata', ['css' => 'text-center']);
            exit;
        }
        return $result;
    }
    //-----------------------------------------------------
    // /tpadmin/cs/sheet 読込時の挙動
    //-----------------------------------------------------
    public static function tpadminCsSheetAjax($get, $postPrimaryKey, $dataformat = false, $categoryFilter = true): array
    {
        $getPrimaryKey = appFuncArray::issetKey($get, appDatabaseCs::primaryKey, '');
        $csCategory = "";
        if ($categoryFilter === true) {
            /*判断：カテゴリ絞込みの制限あり*/
            $csCategory = appConfigStatus::csCategorySheet;
        }
        if ($postPrimaryKey != '') {
            /*分岐1：既存データ参照...データ送信処理が実行された*/
            $result = self::getDataSingle($postPrimaryKey, $csCategory, $dataformat);
        } else if ($getPrimaryKey != '') {
            /*分岐2：既存データ参照...クエリパラメータにcs_idあり*/
            $result = self::getDataSingle($getPrimaryKey, $csCategory, $dataformat);
        } else {
            /*分岐3：新規データ*/
            $result = [];
        }
        if (isset($result['cs_category']) && $result['cs_category'] === appConfigStatus::csCategoryLog) {
            /*判断：カテゴリは対応ログ */
            $sheet_cs_id = appFuncArray::issetKey($result, 'sheet_cs_id', '');
            if ($sheet_cs_id === '') {
                /*分岐1：送客シート未作成の場合、cs_idの値を初期化*/
                $result[self::primaryKey] = '';
            } else if ($sheet_cs_id != '') {
                /*分岐2：送客シート作成済*/
                appFuncModule::component('nodata', ['css' => 'text-center', 'title' => '送客シートは作成済です']);
                exit;
            }
        }
        if ($result === []) {
            /*判断：データが存在しない*/
            appFuncModule::component('nodata', ['css' => 'text-center']);
            exit;
        }
        return $result;
    }
    //-----------------------------------------------------
    // テキスト作成：検索結果
    //-----------------------------------------------------
    public static function searchString(array $get = []): string
    {
        $result = "";
        foreach ($get as $rowName => $value) {
            /*getパラメータ走査*/
            if (isset(self::db[$rowName]) && $value != '') {
                /*分岐1：DBに値が存在するパラメータ*/
                if (self::db[$rowName]['input'] === 'hidden') {
                    /*分岐1-1：非表示フォーム*/
                    continue;
                }
                if (self::db[$rowName]['input'] === 'select') {
                    /*分岐1-2：セレクトメニュー*/
                    $value = appFuncDataformat::selectmenu($value, self::dbClass, $rowName);
                }
                $result .= self::db[$rowName]['comment'];
                $result .= '「' . $value . '」、';
            }
        }
        if ($result != '') {
            /*判断：文字が存在*/
            $result = mb_substr($result, 0, -1);
        }
        return $result;
    }
}
