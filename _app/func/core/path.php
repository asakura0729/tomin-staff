<?php
//======================================================================
// ファイルパスの取得・作成
//======================================================================
class appFuncPath
{
    public const sitemap = appRoutesWeb::sitemap;
    public const pageContents = appRoutesWeb::pageContents;
    //-----------------------------------------------------
    // パス取得
    //-----------------------------------------------------
    public static function getPath(): string
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return  $path;
    }
    //-----------------------------------------------------
    // クエリパラメータ取得
    //-----------------------------------------------------
    public static function getQuery(): string
    {
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        return '?' . $query;
    }
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
    // hx-get作成
    //-----------------------------------------------------
    public static function hxGet(): string
    {
        $result = '';
        $path = self::getPath();
        $getParam = self::getQuery();
        foreach (self::sitemap as $page) {
            if ($page[appRoutesWeb::pagePath] === $path) {
                $result = $page[self::pageContents];
                $result .= $getParam;
                break;
            }
        }
        return $result;
    }
}
