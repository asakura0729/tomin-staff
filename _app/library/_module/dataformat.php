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
    // バインドパラメータ設定
    //-----------------------------------------------------
    public static function dbPost(array $post = [], array $table = []): array
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
