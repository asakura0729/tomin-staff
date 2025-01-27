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
        if ($cssClass != '') {
            $cssClass = ' ' . $cssClass;
        }
        include __DIR__ . '/../../../_module/heading/' . $tag . '.php';
    }

    //-----------------------------------------------------
    // フォーム要素の読み込み
    //-----------------------------------------------------
    public static function form(string $tmplName, string $name = "", string $title = "", string $value = "", array $option = [])
    {
        $placeholder = appFuncArray::issetKey($option, 'placeholder');
        $add = appFuncArray::issetKey($option, 'add');
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
        foreach ($inputNames as $index => $inputName) {
            $tableRow = appFuncArray::issetKey($tableConfig, $inputName);
            $title = appFuncArray::issetKey($tableRow, 'title');
            $title = appFuncArray::issetKey($titles, $index, $title);
            $placeholder = appFuncArray::issetKey($tableRow, 'placeholder');
            $value = appFuncArray::issetKey($result, $inputName);
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

    public static function formChoices($tmpl, $title, $name, $value = null, $choices = array(),  $add = null)
    {
        include $tmpl;
    }

    public static function btn($tmpl, $title, $classIcon = null, $add = null)
    {
        include $tmpl;
    }

    public static function hxLink($sitemapKey, $option = [])
    {
        $setQueryParams = appFuncArray::issetKey($option, 'getParams', []);
        if (!isset(appConfigSite::sitemap[$sitemapKey])) {
            return;
        }
        $page = appConfigSite::sitemap[$sitemapKey];
        $target = appConfigPage::pageMain;
        $hxGet = appFuncArray::issetKey($page, 'contents', '');
        $hxPushUrl = appFuncArray::issetKey($page, 'path', '');
        $hxReplaceUrl = appFuncArray::issetKey($page, 'path', '');
        $getParams = appFuncArray::issetKey($page, 'getParams', []);
        if (count($getParams) > 0) {
            $addGetParam = '?';
            foreach ($getParams as $index => $getParam) {
                $getParamValue = appFuncArray::issetKey($setQueryParams, $index, '');
                $addGetParam .=  $getParam . '=' . $getParamValue . '&';
            }
            $addGetParam = substr($addGetParam, 0, -1);
            $hxGet .= $addGetParam;
            $hxPushUrl .= $addGetParam;
            $hxReplaceUrl .= $addGetParam;
        }
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
        foreach (appConfigSite::sitemap as $page) {
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
}
