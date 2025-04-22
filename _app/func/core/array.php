<?php
//======================================================================
// 配列操作
//======================================================================
class appFuncArray
{
    //-----------------------------------------------------
    // 関数：配列にキーがあれば返す($keyは何が入るかわからないため型未指定)
    //-----------------------------------------------------
    public static function issetKey(array $array, $key, $val = null)
    {
        if (is_array($array) && isset($array[$key]) && $key != null) {
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
    //-----------------------------------------------------
    // 空白区切りのテキストをを配列で返す
    //-----------------------------------------------------
    public static function getWords($word): array
    {
        $result = [];
        $search = array("　", " ");
        $word_comma = str_replace($search, ",", $word);
        $word_arr = explode(",", $word_comma);
        foreach ($word_arr as $value) {
            if ($value != '') {
                $result[] = $value;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 関数：配列を走査し、文字列を作成
    //-----------------------------------------------------
    public static function arrayToString(array $arrays, string $filterParam = "", string $filterValue = ""): string
    {
        $result = "";
        echo $keyValue;
        foreach ($arrays as $key => $value) {
            echo $value[$key];
            if ($key === '' || isset($value[$filterParam]) && $value[$filterParam] === $filterValue) {
                $result .= $value;
            }
        }
        return $result;
    }
}
