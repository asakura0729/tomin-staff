<?php
//======================================================================
// データ整形
//======================================================================
class appLibraryDataformat
{
    //-----------------------------------------------------
    // 設定
    //-----------------------------------------------------
    private const row = appConfigDatabase::row;
    private const auto_increment = appConfigDatabase::auto_increment;

    //-----------------------------------------------------
    // DB取得データ整形
    //-----------------------------------------------------
    public static function dbResult(array $dbResult = [], array $table = []): array
    {
        $result = [];
        foreach ($table as $tableRow) {
            $row = $tableRow[self::row];
            $dataFormat = appFuncArray::issetKey($tableRow, 'format', '');
            $result[$row] = appFuncArray::issetKey($dbResult, $row, '');
            if ($result[$row] != null) {
                switch ($dataFormat) {
                    case 'json':
                        $result[$row . '_jd'] = json_decode($result[$row], true);
                        break;
                }
            } else {
                $result[$row] = "";
            }
        }
        return $result;
    }

    //-----------------------------------------------------
    // DB取得データデフォルト値適用
    //-----------------------------------------------------
    public static function dbResultSetDefaultVal(array $dbResult = [], array $table = [], string $key = ""): string
    {
        $row = $table[$key][appConfigDatabase::row];
        if (isset($dbResult[$row])) {
            $result = $dbResult[$row];
        } else if (isset($dbResult[$row]['value'])) {
            $result = $dbResult[$row]['value'];
        } else {
            $result = "";
        }
        return $result;
    }

    //-----------------------------------------------------
    // 複数のPOSTデータを整形
    //-----------------------------------------------------
    public static function dbPostMultiple(array $post, string $key): array
    {
        $result = [];
        $count = 0;
        if (isset($post[$key])) {
            foreach ($post[$key] as $keyValue) {
                foreach ($post as $inputName => $inputValue) {
                    $result[$count][$inputName] = $post[$inputName][$count];
                }
                $count++;
            }
        }
        return $result;
    }

    //-----------------------------------------------------
    // データベースに追加するValue値を設定
    //-----------------------------------------------------
    public static function dbPostParam($table, $primaryKey, $post): array
    {
        $dbpost = [];
        foreach ($table as $tableRow) {
            $inputName = $tableRow[appConfigDatabase::row];
            $dataFormat = appFuncArray::issetKey($tableRow, 'format', '');
            if (isset($post[$inputName])) {
                /*判断：テーブルに定義された値がPOSTに存在*/
                $dbpost[$inputName] = $post[$inputName];
            } elseif (isset($tableRow['value'])) {
                /*判断：テーブルにデフォルト値が存在*/
                $dbpost[$inputName] = $tableRow['value'];
            }
            switch ($dataFormat) {
                case 'date':
                    $date = new DateTime($dbpost[$inputName]);
                    $dbpost[$inputName] = $date->format('Y-m-d');
                    break;
                case 'int':
                    $dbpost[$inputName] = intval($dbpost[$inputName]);
                    break;
            }
        }
        $date = date('Y-m-d H:i:s');
        if (isset($post[$primaryKey])) {
            $dbpost['update_date'] = $date;
            $dbpost['update_by'] = $_SESSION[appConfigSession::userId];
            if ($post[$primaryKey] === '') {
                /*分岐：新規*/
                $dbpost['insert_date'] = $date;
                $dbpost['insert_by'] = $_SESSION[appConfigSession::userId];
            }
        }
        return $dbpost;
    }

    //-----------------------------------------------------
    // バインドパラメータ作成
    //-----------------------------------------------------
    public static function bindParam(array $dbPostParam = [], array $table = []): array
    {
        $result = [];
        foreach ($table as $value) {
            $row = $value[self::row];
            $paramKey = ':' . $row;
            $auto_increment = appFuncArray::issetKey($value, self::auto_increment, false);
            if ($auto_increment === true) {
                continue;
            }
            if (isset($dbPostParam[$row])) {
                $result[$paramKey] = $dbPostParam[$row];
            }
        }
        return $result;
    }
}
