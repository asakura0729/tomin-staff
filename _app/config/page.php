<?php
//======================================================================
// 個別ページの設定
//======================================================================
class appConfigPage
{
    /*各ページで使用する値*/
    public static $title = null; //ページのタイトル
    public static $titleAdd = null; //ページのタイトル（追加要素）
    public static $description = null; //meta description
    public static $ogimage = null; //ogp image
    public static $uri = null; //ogp url
    public static $css = null; //<head>内に記載するCSS
    public static $js = null; //<head>内に記載するJS
    public static $tmpl = ""; //ページの見た目を切り替える際に使用する変数
    public static $pageCategory = null; //ページのカテゴリ
    public static $path = ""; //ファイルパス
}
