<?php
//======================================================================
// 文字列の処理
//======================================================================
class appFuncString
{
    /*
    文字列に強制的に文字を差し込む
    */
    public static function addText($str, $val, $add)
    {
        $str1 = mb_substr($str, 0, $val);
        $str2 = mb_substr($str, $val);
        $result = $str1 . $add . $str2;
        return $result;
    }
    /*
    数値にコンマを入れる
    */
    public static function omitInt($int): string
    {
        $result = $int;
        $int = intval($int);
        if ($int != 0) {
            $result = number_format($int);
        }
        return $result;
    }
    /*
    時刻のフォーマット
    */
    public static function datetime($datetime, $type = "datetime")
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
    /*
    文字列を切り出し
    */
    public static function extract($str, $val)
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
