<?php
//======================================================================
// SQL文の作成
//======================================================================
class appLibraryEditsql
{
    //-----------------------------------------------------
    // 設定
    //-----------------------------------------------------
    private const row = appConfigDatabase::row;
    private const auto_increment = appConfigDatabase::auto_increment;

    //-----------------------------------------------------
    // SQL文作成：最新のIDを一件取得
    //-----------------------------------------------------
    public static function getLatest($tableName, $table, $primaryKey): string
    {
        $sql = self::requestSql(['tableName' => $tableName, 'table' => $table, 'filter' => [$primaryKey]]);
        $sql .= ' ORDER BY ' . $primaryKey . ' DESC LIMIT 1';
        return $sql;
    }

    //-----------------------------------------------------
    // SQL文作成：insertされたばかりのindex値を取得
    //-----------------------------------------------------
    public static function getInsertID(): string
    {
        $sql = 'SELECT LAST_INSERT_ID() as primaryKey;';
        return $sql;
    }

    //-----------------------------------------------------
    // IDの存在を確認
    //-----------------------------------------------------
    public static function getExistence($tableName, $table, $primaryKey, $id): string
    {
        $sql = self::requestSql(['tableName' => $tableName, 'table' => $table, 'filter' => [$primaryKey]]);
        $sql .= ' WHERE ' . $primaryKey . '=' . $id;
        return $sql;
    }

    //-----------------------------------------------------
    // SQL文作成：データ取得用
    //-----------------------------------------------------
    public static function requestSql(...$tableArr): string
    {
        $select = "";
        $from = "";
        $prevTableName = "";
        foreach ($tableArr as $index => $col) {
            $tableName = appFuncArray::issetKey($col, 'tableName', '');
            $table = appFuncArray::issetKey($col, 'table', []);
            $filter = appFuncArray::issetKey($col, 'filter', []);
            $primaryKey = appFuncArray::issetKey($col, 'primaryKey', '');
            $select .= self::select($tableName, $table, $filter);
            if ($index > 0) {
                $from .= ' LEFT JOIN ' . $tableName . ' ON ' . $prevTableName . '.' . $primaryKey . ' = ' . $tableName . '.' .  $primaryKey;
            } else {
                $from .= $tableName;
            }
            $prevTableName = $tableName;
        }
        $select = substr($select, 0, -1);
        $result =  'select ' . $select . ' from ' . $from . ' ';
        return $result;
    }

    //-----------------------------------------------------
    // SQL文作成：SELECT文
    //-----------------------------------------------------
    public static function select(string $tableName, array $table, array $filter = []): string
    {
        $filterCount = count($filter);
        $filterList = [];
        foreach ($filter as $value) {
            $filterList[$value] = $value;
        }
        $results = '';
        foreach ($table as $index => $row) {
            $col = $row[self::row];
            if ($filterCount === 0 || isset($filterList[$col])) {
                $results .= $tableName . '.' . $col . ',';
            }
        }
        return $results;
    }

    //-----------------------------------------------------
    // SQL文作成：insert文作成
    //-----------------------------------------------------
    public static function insertSql(array $option = []): string
    {
        $table = appFuncArray::issetKey($option, 'table', []);
        $tableName = appFuncArray::issetKey($option, 'tableName', '');
        $dbPost = appFuncArray::issetKey($option, 'dbPost', '');
        $sqlkey = '';
        $sqlParam = '';
        foreach ($table as $index => $row) {
            $rowKey = $row[self::row];
            $auto_increment = appFuncArray::issetKey($row, self::auto_increment, '');
            if ($auto_increment != true) {
                if (isset($dbPost[$rowKey])) {
                    $sqlkey .=  '`' . $rowKey . '`,';
                    $sqlParam .= ':' . $rowKey . ',';
                }
            }
        }
        $sqlkey = substr($sqlkey, 0, -1);
        $sqlParam = substr($sqlParam, 0, -1);
        return  'INSERT INTO `' . $tableName . '`(' . $sqlkey . ') VALUES (' . $sqlParam . ');';
    }

    //-----------------------------------------------------
    // SQL文作成：update文作成
    //-----------------------------------------------------
    public static function updateSql(array $option = []): string
    {
        $table = appFuncArray::issetKey($option, 'table', []);
        $tableName = appFuncArray::issetKey($option, 'tableName', '');
        $dbPost = appFuncArray::issetKey($option, 'dbPost', '');
        $sqlParam = '';
        foreach ($table as $index => $row) {
            $rowKey = $row[self::row];
            $auto_increment = appFuncArray::issetKey($row, self::auto_increment, '');
            if ($auto_increment != true) {
                if (isset($dbPost[$rowKey])) {
                    $sqlParam .= '`' . $rowKey . '`=:' . $rowKey . ',';
                }
            }
        }
        $sqlParam = substr($sqlParam, 0, -1);
        return 'UPDATE `' . $tableName . '` SET ' . $sqlParam;
    }
}
