<?php
//======================================================================
// ページの制御
//======================================================================
class appFuncPage
{
    //-----------------------------------------------------
    // キャッシュさせない
    //-----------------------------------------------------
    public static function noCache()
    {
        header("Expires: Thu, 01 Jan 1970 00:00:00 GMT"); // 過去日時
        header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
        header("Cache-Control: post-check=0, pre-check=0", false);     // IE対応
        header("Pragma: no-cache"); // HTTP/1.0
    }
}
