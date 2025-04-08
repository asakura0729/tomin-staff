<?php
//======================================================================
// 表示・描画関係（関数を実行するとechoが行われる）
//======================================================================
class appFuncDisp
{

    public static function arrayCountString(array $array, string $strTrue = "", string $strFalse = "")
    {
        if (count($array) > 0) {
            echo $strTrue;
        } else {
            echo $strFalse;
        }
    }
    public static function boolString($bool, string $strTrue = "", string $strFalse = "")
    {
        if ($bool === true) {
            echo $strTrue;
        } else {
            echo $strFalse;
        }
    }
    //-----------------------------------------------------
    // 画像描画
    //-----------------------------------------------------
    public static function img(string $imgName, array $option = [])
    {
        echo '<img src="/assets/img/' . $imgName . '" alt="イメージ" class="w-100">';
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
        $hxTarget = appFuncArray::issetKey($option, 'hxTarget', appConfigPage::pageMain);
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
    //-----------------------------------------------------
    // hx-get描画
    //-----------------------------------------------------
    public static function hxGet(): string
    {
        $result = "";
        $path = appFuncPath::getPath();
        $getParam = appFuncPath::getQuery();
        foreach (appRoutesWeb::sitemap as $page) {
            if ($page['path'] === $path) {
                $result = $page[appRoutesWeb::pageContents];
                $result .=  $getParam;
                break;
            }
        }
        return $result;
    }

    public static function compColBg(string $str, string $matchStr)
    {
        if ($str === $matchStr) {
            echo 'bg-lgray';
        }
    }
}
