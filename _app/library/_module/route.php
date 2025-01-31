<?php
//======================================================================
// 表示・描画関係
//======================================================================
class appLibraryRoute
{
    public static function pageLink($sitemapKey, $row, $params = []): string
    {
        $result = appRoutesWeb::sitemap[$sitemapKey][$row];
        $getParams = appFuncArray::issetKey(appRoutesWeb::sitemap[$sitemapKey], appRoutesWeb::sitemapGetParams, []);
        foreach ($getParams as $value) {
            $result .= $value . '=';
        }
    }
}
