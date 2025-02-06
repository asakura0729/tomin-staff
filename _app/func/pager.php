<?php
//======================================================================
// ページング
//======================================================================
class appFuncPager
{

    public const getPage = appRoutesWeb::getPage;
    public const limitCount = appConfigDatabase::pageColCount;
    public const maxPagerCount = appConfigDatabase::pagerCount;
    public const tmplFile = __DIR__ . '/../../_module/pager.php';

    public static function disp(
        $hxGet,
        $hxPush,
        $totalElementsCount,
        $limitCount = self::limitCount,
        $dispMaxPagerCount = self::maxPagerCount
    ) {
        /*
        $sitemapKey・・・遷移先ページ
        $totalElementsCount・・・データの総数
        $limitCount・・・1ページに表示できる記事数
        $dispMaxPagerCount・・・ページネーションの要素数（最大値）
        */

        $tmplFile = self::tmplFile;

        //基本Uri
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $cleaned_query = preg_replace('/(\?|&)page=[^&]+&?/', '$1', $query);
        $cleaned_query = preg_replace('/\?$|&$/', '', $cleaned_query);
        $hxPush = $hxPush . '?' . $cleaned_query . '&' . self::getPage . '=';
        $hxGet = $hxGet . '?' .  $cleaned_query . '&' . self::getPage . '=';

        //ページネーションの要素数
        $pagerCount = $totalElementsCount / $limitCount;
        if (is_float($pagerCount)) {
            $pagerCount  = ceil($pagerCount);
        }

        //現在のページ番号
        $currentPageNum = 1;
        if (isset($_GET[self::getPage])) {
            $currentPageNum = preg_replace('/[^0-9]/', '', $_GET[self::getPage]);
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
