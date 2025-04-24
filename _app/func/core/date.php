<?php
//======================================================================
// 時間・年月の処理
//======================================================================
class appFuncDate
{
    //-----------------------------------------------------
    // 数値をY-m-d h:i形式に変換
    //-----------------------------------------------------
    public static function dateFormat($str = ""): string
    {
        $date = DateTime::createFromFormat("YmdHi", $str);
        if ($date) {
            $result =  $date->format("Y-m-d H:i");
        } else {
            $result = date("Y-m-d H:i");
        }
        return $result;
    }
}
