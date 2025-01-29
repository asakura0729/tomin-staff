<?php
//======================================================================
// 表示・描画関係
//======================================================================
class appLibraryRoute
{
    public static function pageLink($sitemapKey, $row, $params = []): string
    {
        $result = appConfigSite::sitemap[$sitemapKey][$row];
        $getParams = appFuncArray::issetKey(appConfigSite::sitemap[$sitemapKey], appConfigSite::sitemapGetParams, []);
        foreach ($getParams as $value) {
            $result .= $value . '=';
        }
    }
}
