<?php
//======================================================================
// 表示・描画関係
//======================================================================
class appLibraryDisp
{
    public static function h1($tmpl, $title, $addText = null)
    {
        include $tmpl;
    }

    //-----------------------------------------------------
    // 見出し要素の読み込み
    //-----------------------------------------------------
    public static function heading($tag, $title, $option = [])
    {
        $cssClass = appFuncArray::issetKey($option, 'class', '');
        $icon = appFuncArray::issetKey($option, 'icon', '');
        if ($cssClass != '') {
            $cssClass = ' ' . $cssClass;
        }
        include __DIR__ . '/../../../_module/heading/' . $tag . '.php';
    }

    //-----------------------------------------------------
    // フォーム要素の読み込み
    //-----------------------------------------------------
    public static function form(string $tmplName, string $inputName = "", string $title = "", string $value = "", array $option = [])
    {
        $placeholder = appFuncArray::issetKey($option, 'placeholder');
        $selectItem = appFuncArray::issetKey($option, 'selectItem', []);
        $add = appFuncArray::issetKey($option, 'add');
        $multiple = appFuncArray::issetKey($option, 'multiple', false);
        include __DIR__ . '/../../../_module/form/' . $tmplName . '.php';
    }

    //-----------------------------------------------------
    // フォーム要素の読み込み（DB連携）
    //-----------------------------------------------------
    public static function dbform(string $tmplName, array $inputNames, array $tableConfig, array $result = [], array $option = [])
    {
        $titles = appFuncArray::issetKey($option, 'title', []);
        $selectItem = appFuncArray::issetKey($option, 'selectItem', []);
        $add = appFuncArray::issetKey($option, 'add', '');
        $multiple = appFuncArray::issetKey($option, 'multiple', false);
        $overwriteValue = appFuncArray::issetKey($option, 'value', '');
        $css = appFuncArray::issetKey($option, 'css', '');
        foreach ($inputNames as $index => $inputName) {
            $tableRow = appFuncArray::issetKey($tableConfig, $inputName);
            $title = appFuncArray::issetKey($tableRow, 'title');
            $title = appFuncArray::issetKey($titles, $index, $title);
            $placeholder = appFuncArray::issetKey($tableRow, 'placeholder');
            $value = appFuncArray::issetKey($result, $inputName);
            if ($overwriteValue != '') {
                $value = $overwriteValue;
            }
            if ($multiple === true) {
                $inputName = $inputName . '[]';
            }
            include __DIR__ . '/../../../_module/form/' . $tmplName . '.php';
        }
    }

    public static function dbRow(array $tableConfig, string $row): string
    {
        return $tableConfig[$row][appConfigDatabase::row];
    }

    public static function dbRowTitle(array $tableConfig, string $col): string
    {
        return $tableConfig[$col]['title'];
    }

    public static function arrayCountString(array $array, string $strTrue = "", string $strFalse = "")
    {
        if (count($array) > 0) {
            echo $strTrue;
        } else {
            echo $strFalse;
        }
    }


    public static function  strlenString(string $string, string $strTrue = "", string $strFalse = "")
    {
        if (strlen($string) > 0) {
            echo $strTrue;
        } else {
            echo $strFalse;
        }
    }

    public static function btn($tmpl, $title, $classIcon = null, $add = null)
    {
        include $tmpl;
    }

    public static function link($sitemapKey, $option = [])
    {
        $pathKey = appFuncArray::issetKey($option, 'path', 'path');
        $params = appFuncArray::issetKey($option, 'params', []);
        $path = appRoutesWeb::sitemap[$sitemapKey][$pathKey];
        $getParams = appFuncArray::issetKey(appRoutesWeb::sitemap[$sitemapKey], appRoutesWeb::sitemapGetParams, []);
        $addGetParam = appFuncPath::setGetParam($getParams, $params);
        $result = $path . $addGetParam;
        echo $result;
    }

    public static function hxLink($sitemapKey, $option = [])
    {
        $setQueryParams = appFuncArray::issetKey($option, appRoutesWeb::sitemapGetParams, []);
        if (!isset(appRoutesWeb::sitemap[$sitemapKey])) {
            return "";
        }
        $pageData = appRoutesWeb::sitemap[$sitemapKey];
        $target = appConfigPage::pageMain;
        $hxGet = appFuncArray::issetKey($pageData, 'contents', '');
        $hxPushUrl = appFuncArray::issetKey($pageData, 'path', '');
        $hxReplaceUrl = appFuncArray::issetKey($pageData, 'path', '');
        $getParams = appFuncArray::issetKey($pageData, appRoutesWeb::sitemapGetParams, []);
        $addGetParam = appFuncPath::setGetParam($getParams, $setQueryParams);
        $hxGet .= $addGetParam;
        $hxPushUrl .= $addGetParam;
        $hxReplaceUrl .= $addGetParam;
        $result = <<<EOF
            hx-push-url="{$hxPushUrl}" hx-replace-url="{$hxReplaceUrl}" data-hx-get="{$hxGet}" data-hx-target="{$target}"
            EOF;
        echo $result;
    }

    public static function hxGet()
    {
        $uriArr = explode('?', $_SERVER['REQUEST_URI']);
        $path = appFuncArray::issetKey($uriArr, 0, '');
        $getParam = appFuncArray::issetKey($uriArr, 1, '');
        $result = "";
        foreach (appRoutesWeb::sitemap as $page) {
            if ($page['path'] === $path) {
                $includeFile = $page['contents'];
                if ($getParam != '') {
                    $includeFile .=  '?' . $getParam;
                }
                $result = <<<EOF
                data-hx-get="{$includeFile}" hx-trigger="load once"
                EOF;
                break;
            }
        }
        echo $result;
    }

    public static function globalModule(string $tmpl, array $option = [])
    {
        include __DIR__ . '/../../../_module/' . $tmpl . '.php';
    }

    public static function module(string $tmpl, array $option = [])
    {
        include $tmpl;
    }

    /*ページングを描画*/
    public static function pager($sitemapKey, $totalElementsCount, $limitCount = appConfigDatabase::pageColCount, $dispMaxPagerCount = appConfigDatabase::pagerCount)
    {
        /*
        $totalElementsCount・・・データの総数
        $limitCount・・・1ページに表示できる記事数
        $dispMaxPagerCount・・・ページネーションの要素数（最大値）
        */

        $tmplFile = __DIR__ . '/../../../_module/pager.php';

        //基本Uri
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $cleaned_query = preg_replace('/(\?|&)page=[^&]+&?/', '$1', $query);
        $cleaned_query = preg_replace('/\?$|&$/', '', $cleaned_query);
        $hxPush = appRoutesWeb::sitemap[$sitemapKey]['path'] . '?' . $cleaned_query . '&' . appRoutesWeb::getPage . '=';
        $hxGet = appRoutesWeb::sitemap[$sitemapKey]['contents'] . '?' .  $cleaned_query . '&' . appRoutesWeb::getPage . '=';

        //ページネーションの要素数
        $pagerCount = $totalElementsCount / $limitCount;
        if (is_float($pagerCount)) {
            $pagerCount  = ceil($pagerCount);
        }

        //現在のページ番号
        $currentPageNum = 1;
        if (isset($_GET[appRoutesWeb::getPage])) {
            $currentPageNum = preg_replace('/[^0-9]/', '', $_GET["page"]);
        }

        //ページネーションの開始数値
        $pageNum = $currentPageNum - 2;
        if ($pageNum <= 0 || $pagerCount < $dispMaxPagerCount) {
            $pageNum = 1;
        } else if ($pageNum >= $pagerCount - $dispMaxPagerCount && $pagerCount > $dispMaxPagerCount) {
            $pageNum = $pagerCount - $dispMaxPagerCount + 1;
        }

        //ページネーションの数値格納
        $pageNumArray = [];
        for ($i = 0; $i < $pagerCount; $i++) {
            $pageNumArray[] = $pageNum + $i;
            if ($i >= $dispMaxPagerCount - 1) {
                break;
            }
        }

        //ページネーション:prev
        $pageNumPrev = $currentPageNum - 1;
        //ページネーション:next
        $pageNumNext = $currentPageNum + 1;

        include_once $tmplFile;
    }
}
