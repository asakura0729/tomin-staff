<?php
//======================================================================
// 表示・描画関係（関数を実行すると直接描画が行われる）
//======================================================================
class appFuncDisp
{
    //-----------------------------------------------------
    // 画像描画
    //-----------------------------------------------------
    public static function img(string $imgName, array $option = [])
    {
        $alt = appFuncArray::issetKey($option, 'alt', 'イメージ');
        $cssClass = appFuncArray::issetKey($option, 'css', 'w-100');
        $add = appFuncArray::issetKey($option, 'add', '');
        echo <<<EOF
        <img src="/assets/img/{$imgName}" alt="{$alt}" class="{$cssClass}" {$add}/>
        EOF;
    }
    //-----------------------------------------------------
    // ハイパーリンク描画（HTMX）
    //-----------------------------------------------------
    public static function hxLink(array $sitemapData, string $queryParam = "", array $option = [])
    {
        $hxGet = $sitemapData[appRoutesWeb::pageContents];
        $hxPushUrl = $sitemapData[appRoutesWeb::pagePath];
        $hxReplaceUrl = $sitemapData[appRoutesWeb::pagePath];
        $hxGet .= $queryParam;
        $hxPushUrl .= $queryParam;
        $hxReplaceUrl .= $queryParam;
        $hxTarget = appFuncArray::issetKey($option, 'hxTarget', appConfigSite::pageMain);
        $hxGetFlg = appFuncArray::issetKey($option, 'hxGetFlg', true);
        $hxPushFlg = appFuncArray::issetKey($option, 'hxPushFlg', true);
        $result = "";
        if ($hxGetFlg === true) {
            $result .= 'href="#" data-hx-get="' . $hxGet . '" ';
            $result .= 'data-hx-target="' . $hxTarget . '" ';
            if ($hxPushFlg === true) {
                $result .= 'data-hx-push-url="' . $hxPushUrl . '" data-change-gnav';
            }
        } else {
            $result .= 'href="' . $hxGet . '" ';
        }
        echo $result;
        /*data-hx-get="{$hxGet}" data-hx-push-url="{$hxPushUrl}" data-hx-replace-url="{$hxReplaceUrl}" data-hx-target="{$target}"*/
    }
}
