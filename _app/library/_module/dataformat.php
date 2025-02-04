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
        foreach ($table as $value) {
            $row = $value[self::row];
            $result[$row] = appFuncArray::issetKey($dbResult, $row, '');
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
    public static function dbPostParam($table, $post): array
    {
        $dbpost = [];
        foreach ($table as $row) {
            $inputName = $row[appConfigDatabase::row];
            if (isset($post[$inputName])) {
                $dbpost[$inputName] = $post[$inputName];
            }
        }
        return $dbpost;
    }

    //-----------------------------------------------------
    // バインドパラメータ作成
    //-----------------------------------------------------
    public static function bindParam(array $post = [], array $table = []): array
    {
        $result = [];
        foreach ($table as $value) {
            $row = $value[self::row];
            $paramKey = ':' . $row;
            $auto_increment = appFuncArray::issetKey($value, self::auto_increment, false);
            if ($auto_increment === true) {
                continue;
            }
            if (isset($post[$row])) {
                $result[$paramKey] = $post[$row];
            }
        }
        return $result;
    }
}
