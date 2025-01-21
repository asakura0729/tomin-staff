<?php
/*======================================================================

データベースまわりの関数

======================================================================*/
class appFuncUri
{

    public static function categoryName(): string
    {
        $categoryName = dirname($_SERVER["SCRIPT_NAME"]);
        return $categoryName;
    }

    public static function getUri($int = null): string
    {
        $uri = $_SERVER['REQUEST_URI'];
        $array = explode("/", $uri);
        if ($int === null) {
            return $uri;
        }
        if (isset($array[$int]) && $array[$int] != '') {
            return $array[$int];
        } else {
            return 'home';
        }
    }
}
