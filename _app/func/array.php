<?php
//======================================================================
// 配列操作
//======================================================================
class appFuncArray
{
    //-----------------------------------------------------
    // 関数：配列にキーがあれば返す
    //-----------------------------------------------------
    public static function issetKey(array $array, string $key, $val = null)
    {
        if (is_array($array) && isset($array[$key])) {
            /*分岐1：配列内に値がある*/
            $result = $array[$key];
        } else {
            /*分岐2：配列内に値がない*/
            $result = $val;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 関数：配列を結合
    //-----------------------------------------------------
    public static function arrayMerge(array $arrays): array
    {
        $result = [];
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
