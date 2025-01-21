<?php
/*======================================================================

個ページ

======================================================================*/
class appConfigPage
{
    public static $uri = null;
    public static $id = null;
    public static $title = null;
    public static $description = null;
    public static $ogimage = null;
    public static $css = null;
    public static $js = null;
    public static $tmpl = 'default';
    public static $pageCategory = null;
    public static $userName = null;
    public static $breadcrumb = [];
    public static $date = null;
}
appConfigPage::$date = date('ymdhis');
