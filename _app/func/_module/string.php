<?php
//======================================================================
// 文字列の加工
//======================================================================
class appFuncString
{
    //-----------------------------------------------------
    // 文字列が0文字以下の場合、代替テキストを返す
    //-----------------------------------------------------
    public static function strlenString(string $string, string $strTrue = "", string $strFalse = ""): string
    {
        if (strlen($string) > 0) {
            return $strTrue;
        } else {
            return $strFalse;
        }
    }
    //-----------------------------------------------------
    // ランダム文字列を返す
    //-----------------------------------------------------
    public static function randomText(): string
    {
        $now = microtime(true);
        $result = (int)(($now - (int)$now) * 1000);
        $result .= rand(10000, 99999);
        return $result;
    }
    //-----------------------------------------------------
    // 値に応じたテキストを返す
    //-----------------------------------------------------
    public static function switchString(string $string, array $key, array $results, string $defaultResult = ""): string
    {
        $result = $defaultResult;
        foreach ($key as $index => $value) {
            if ($string === $value) {
                $result = $results[$index];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 文字列に強制的に文字を差し込む
    //-----------------------------------------------------
    public static function addText($str, $val, $add): string
    {
        $str1 = mb_substr($str, 0, $val);
        $str2 = mb_substr($str, $val);
        $result = $str1 . $add . $str2;
        return $result;
    }
    //-----------------------------------------------------
    // 数値にコンマを入れる
    //-----------------------------------------------------
    public static function omitInt($int): string
    {
        $result = $int;
        $int = intval($int);
        if ($int != 0) {
            $result = number_format($int);
        }
        return $result;
    }
    //-----------------------------------------------------
    // 数値のみを抜き出す
    //-----------------------------------------------------
    public static function getInt($str): string
    {
        $str = preg_match("/^[0-9]+$/", $str);
        return $str;
    }
    //-----------------------------------------------------
    // 時刻のフォーマット
    //-----------------------------------------------------
    public static function datetime($datetime, $type = "datetime"): string
    {
        if ($type === "datetime") {
            $result = date('Y年m月d日 H:i', strtotime($datetime));
        } else  if ($type === "date") {
            $result = date('Y 年 m 月 d 日', strtotime($datetime));
        } else  if ($type === "date_s") {
            $result = date('Y年m月d日', strtotime($datetime));
        } else {
            $result = $datetime;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 文字列を切り出し
    //-----------------------------------------------------
    public static function extract($str, $val): string
    {
        $result = strip_tags($str);
        $result = trim($result);
        $result = mb_substr($result, 0, $val);
        $mb_strlen = mb_strlen($result);
        if ($mb_strlen > $val - 1) {
            $result .= '...';
        }
        return $result;
    }
}
