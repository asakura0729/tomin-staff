<?php
/*======================================================================

ページング

======================================================================*/
class appFuncPager
{
    //ページングを描画
    public static function disp(
        $totalElementsCount,
        $limitCount,
        $dispMaxPagerCount = 10,
        $option = []
    ) {
        /*
         $totalElementsCount・・・データの総数
         $limitCount・・・1ページに表示できる記事数
         $dispMaxPagerCount・・・ページネーションの要素数（最大値）
         $option・・・拡張オプション
         */

        //基本Uri
        $baseUri = preg_replace("/&page=[0-9]{1,}/", "", $_SERVER['REQUEST_URI']);
        if (strpos($baseUri, '?') === false) {
            $baseUri =  $baseUri . '?';
        }

        //ページネーションの要素数
        $pagerCount = $totalElementsCount / $limitCount;
        if (is_float($pagerCount)) {
            $pagerCount  = ceil($pagerCount);
        }

        //現在のページ番号
        $currentPageNum = 1;
        if (isset($_GET["page"])) {
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

        //拡張オプション
        if (isset($option['baseUri'])) {
            $baseUri = $option['baseUri'];
        }
        if (isset($option['appendTarget'])) {
            $appentTarget = $option['appendTarget'];
        }
        if (isset($option['tmplFile'])) {
            $tmplFile = $option['tmplFile'];
        } else {
            $tmplFile = __DIR__ . '/../../_module/pager.php';
        }

        include_once $tmplFile;
    }
}
