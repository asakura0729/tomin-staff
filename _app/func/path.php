<?php
//======================================================================
// ファイルパス関係
//======================================================================
class appFuncPath
{
    //-----------------------------------------------------
    // GETパラメータ作成
    //-----------------------------------------------------
    public static function setGetParam($getParams = [], $getParamValues = []): string
    {
        $result = "";
        if (count($getParams) > 0) {
            $result .= '?';
            foreach ($getParams as $index => $getParam) {
                $getParamValue = "";
                if (isset($getParamValues[$index])) {
                    $getParamValue = $getParamValues[$index];
                }
                $result .=  $getParam . '=' . $getParamValue . '&';
            }
            $result = substr($result, 0, -1);
        }
        return $result;
    }
    //-----------------------------------------------------
    // クエリパラメータ取得
    //-----------------------------------------------------
    public static function getQuery(): string
    {
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        return '?' . $query;
    }
}
