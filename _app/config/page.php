<?php
//======================================================================
// 個別ページの設定
//======================================================================
class appConfigPage
{
    /*各ページで使用する値*/
    public static $title = ""; //ページのタイトル
    public static $titleAdd = ""; //ページのタイトル（追加要素）
    public static $description = ""; //meta description
    public static $ogimage = ""; //ogp image
    public static $uri = ""; //ogp url
    public static $css = ""; //<head>内に記載するCSS
    public static $js = ""; //<head>内に記載するJS
    public static $tmpl = ""; //ページの見た目を切り替える際に使用する変数
    public static $pageCategory = ""; //ページのカテゴリ
    public static $path = ""; //ファイルパス
}
