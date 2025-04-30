<?php
//======================================================================
// SQL文作成
//======================================================================
class appFuncSql
{

    //-----------------------------------------------------
    // 総数を取得
    //-----------------------------------------------------
    public static function getCount(string $tableName, string $primaryKey): string
    {
        $sql = 'SELECT COUNT(' . $tableName . '.' . $primaryKey . ') as count FROM ' . $tableName . ' ';
        return $sql;
    }

    //-----------------------------------------------------
    // insertされたばかりのindex値を取得
    //-----------------------------------------------------
    public static function getInsertID(): string
    {
        $sql = 'SELECT LAST_INSERT_ID() as primaryKey;';
        return $sql;
    }

    //-----------------------------------------------------
    // SELECT文作成
    //-----------------------------------------------------
    public static function select(string $tableName, array $table, string $result = ""): string
    {
        if ($result === '') {
            $result = 'SELECT ';
        } else {
            $result .= ',';
        }
        foreach ($table as $key => $row) {
            $result .= $tableName . '.' . $row[appConfigDatabase::row];
            if ($key != $row[appConfigDatabase::row]) {
                $result .= ' as ' . $key;
            }
            $result .= ',';
        }
        $result = substr($result, 0, -1);
        $result .= ' ';
        return $result;
    }

    //-----------------------------------------------------
    // FROM作成
    //-----------------------------------------------------
    public static function from(string $tableName, string $result = ""): string
    {
        $result .= 'FROM ' . $tableName . ' ';
        return $result;
    }

    //-----------------------------------------------------
    // FROM～JOIN作成
    //-----------------------------------------------------
    public static function join(array $join = [], string $result = ""): string
    {
        $parentTable = $join['parent'];
        $childTable = $join['child'];
        $childAlias = $join['childAlias'];
        $parentKey = $join['parentKey'];
        $childKey = $join['childKey'];
        $result .= 'LEFT JOIN ' . $childTable . ' AS ' . $childAlias;
        $result .=  ' ON ' . $parentTable . '.' . $parentKey . '=' . $childAlias . '.' . $childKey . ' ';
        return $result;
    }

    //-----------------------------------------------------
    // WHERE句作成
    //-----------------------------------------------------
    public static function where(string $tableName, array $table, array $get = [], string $result = ""): string
    {
        if ($result === '') {
            $result = 'WHERE ';
            $result .= self::deleteFlgFalse($tableName);
        }
        foreach ($table as $key => $tableRow) {
            $type = $tableRow['type'];
            if ($type === 'longtext') {
                $result .= self::whereLike($tableName, $tableRow, $get, $key);
            } elseif ($type === 'datetime' || $type === 'date') {
                $result .= self::whereBetween($tableName, $tableRow, $get, $key);
            } else {
                $result .= self::whereEquality($tableName, $tableRow, $get, $key);
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // WHERE句作成...等価演算子作成
    //-----------------------------------------------------
    public static function whereEquality(string $tableName, array $tableRow, array $get, string $key): string
    {
        $result = "";
        $rowName = $tableRow[appConfigDatabase::row];
        if (isset($get[$key]) && $get[$key] != '') {
            $result = ' AND ' . $tableName . '.' . $rowName . ' ="' . $get[$key] . '"';
        }
        return $result;
    }
    //-----------------------------------------------------
    // WHERE句作成...LIKE演算子作成
    //-----------------------------------------------------
    public static function whereLike(string $tableName, array $tableRow, array $get, string $key): string
    {
        $result = "";
        $rowName = $tableRow[appConfigDatabase::row];
        if (isset($get[$key]) && $get[$key] != '') {
            $result = ' AND ' . $tableName . '.' . $rowName . ' LIKE "%' . $get[$key] . '%"';
        }
        return $result;
    }
    //-----------------------------------------------------
    // WHERE句作成...開始日～終了日
    //-----------------------------------------------------
    public static function whereBetween(string $tableName, array $tableRow, array $get, string $key): string
    {
        $result = "";
        $getParam = self::whereBetweenGetParam($get, $key);
        $min = $getParam['min'];
        $max = $getParam['max'];
        $rowName = $tableRow[appConfigDatabase::row];
        if ($min != '' && $min != null) {
            if ($max != '' && $max != null) {
                $result .= ' AND ' . $tableName . '.' . $rowName . ' BETWEEN "' . $min . ' 00:00:00" AND "' . $max . ' 23:59:59"';
            } else {
                $result .= ' AND ' . $tableName . '.' . $rowName . ' ="' . $min . '"';
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // WHERE句作成...開始日～終了日＞値取得
    //-----------------------------------------------------
    public static function whereBetweenGetParam(array $get, string $key): array
    {
        $result = [
            'min' => '',
            'max' => ''
        ];
        if (isset($get[$key]['min'])) {
            $result['min'] = $get[$key]['min'];
        }
        if (isset($get[$key]['max'])) {
            $result['max'] = $get[$key]['max'];
        }
        return $result;
    }
    //-----------------------------------------------------
    // WHERE句作成...削除フラグが無いデータを選定
    //-----------------------------------------------------
    public static function deleteFlgFalse(string $tableName): string
    {
        return  $tableName . '.delete_flg!=' . appConfigDatabase::deleteFlgTrue;
    }

    //-----------------------------------------------------
    // WHERE句作成...検索キーワード絞り込み
    //-----------------------------------------------------
    public static function whereKeywords(string $words, array $rows = []): string
    {
        /*
        $words...検索キーワード
        $rows...検索を行う列
        */
        $result = "";
        $explodeWords = explode(" ", $words);
        if (count($explodeWords) > 0) {
            $result = " AND ";
            foreach ($explodeWords as $explodeWordsKey => $explodeWordsValue) {
                $result .= '(';
                foreach ($rows as $sqlWhereKey => $sqlWhereValue) {
                    $result .= $sqlWhereValue . ' LIKE "%' . $explodeWordsValue . '%"';
                    if ($sqlWhereKey != array_key_last($rows)) {
                        $result .= ' OR ';
                    }
                }
                $result .= ')';
                if ($explodeWordsKey != array_key_last($explodeWords)) {
                    $result .= ' AND ';
                }
            }
        }
        return $result;
    }

    //-----------------------------------------------------
    // ORDER BY句作成
    //-----------------------------------------------------
    public static function orderBy(string $tableName, string $primaryKey): string
    {
        $result = ' ORDER BY ' . $tableName . '.' . $primaryKey . ' DESC';
        return $result;
    }

    //-----------------------------------------------------
    // LIMIT句作成
    //-----------------------------------------------------
    public static function limit(int $elemCount = appConfigDatabase::pageColCount): string
    {
        /*$elemCount...取り出したいデータの数を記入*/
        $pageNum = 1;
        if (isset($_GET[appRoutesWeb::getPage])) {
            $pageNum = intval($_GET[appRoutesWeb::getPage]);
        }
        $result = ' limit ' . $elemCount;
        if (is_numeric($pageNum) === true) {
            if (intval($pageNum) > 1) {
                $pageOffset = ($pageNum - 1) * $elemCount;
                $result = $result . ' offset ' . $pageOffset;
            }
        }
        return $result;
    }

    //-----------------------------------------------------
    // SQL文作成：CREATE文作成
    //-----------------------------------------------------
    public static function createSql($database): string
    {
        $table = $database::table;
        $tableName = $database::tableName;
        $primaryKey = $database::primaryKey;
        $sql = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";<br>';
        $sql .= 'START TRANSACTION;<br>';
        $sql .= 'SET time_zone = "+00:00";<br>';
        $sql .= 'CREATE TABLE `' . $tableName . '` (<br>';
        foreach ($table as $index => $row) {
            $type = $row['type'];
            $constraints = $row['constraints'];
            $comment = $row['comment'];
            $sql .= '`' . $index . '` ' . $type . ' ' . $constraints . ' COMMENT "' . $comment . '",<br>';
        }
        $sql .= 'PRIMARY KEY (`' . $primaryKey . '`)<br>';
        $sql .= ') ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;';
        return $sql;
    }

    //-----------------------------------------------------
    // SQL文作成：insert文作成
    //-----------------------------------------------------
    public static function insertSql($database, array $dbPost): string
    {
        $table = $database::table;
        $tableName = $database::tableName;
        $sqlkey = '';
        $sqlParam = '';
        foreach ($dbPost as $key => $value) {
            $sqlkey .=  '`' . $key . '`,';
            $sqlParam .= ':' . $key . ',';
        }
        $sqlkey = substr($sqlkey, 0, -1);
        $sqlParam = substr($sqlParam, 0, -1);
        return  'INSERT INTO `' . $tableName . '`(' . $sqlkey . ') VALUES (' . $sqlParam . ');';
    }

    //-----------------------------------------------------
    // SQL文作成：update文作成
    //-----------------------------------------------------
    public static function updateSql($database, array $dbPost): string
    {
        $tableName = $database::tableName;
        $sqlParam = '';
        foreach ($dbPost as $key => $value) {
            $sqlParam .= '`' . $key . '`=:' . $key . ',';
        }
        $sqlParam = substr($sqlParam, 0, -1);
        return 'UPDATE `' . $tableName . '` SET ' . $sqlParam;
    }
}
