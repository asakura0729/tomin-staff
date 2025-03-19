<?php
//======================================================================
// WEBサイトの各ページ設定
//======================================================================
class appRoutesWeb
{
    //======================================================================
    //GETパラメータ(汎用)
    //======================================================================
    public const getPage = 'page'; //ページ遷移番号
    public const getWords = 'words'; //検索文字列
    public const getRow = 'row'; //検索文字列の検索範囲
    //======================================================================
    // サイトマップ
    //======================================================================
    public const sitemap = [
        'login' => ['path' => '/login/', 'contents' => null, 'title' => 'ログイン'],
        'admin' => ['path' => '/tpadmin/', 'contents' => '/tpadmin/top/ajax/top', 'title' => '管理画面', 'icon' => 'fa-home'],
        'adminCs' => ['path' => '/tpadmin/cs/', 'contents' => '/tpadmin/cs/ajax/index', 'title' => '対応ログ一覧', 'icon' => 'fa-list-ol'],
        'adminCsEdit' => ['path' => '/tpadmin/cs/edit', 'contents' => '/tpadmin/cs/ajax/edit', 'title' => '対応ログ作成', 'icon' => 'fa-pencil'],
        'adminCsSeet' => ['path' => '/tpadmin/cs_sheet/', 'contents' => '/tpadmin/cs_sheet/ajax/index', 'title' => '送客シート一覧', 'icon' => 'fa-file-text'],
        'adminCsSeetEdit' => ['path' => '/tpadmin/cs_sheet/edit', 'contents' => '/tpadmin/cs_sheet/ajax/edit', 'title' => '送客シート編集', 'icon' => 'fa-file-text'],
        'adminCsSeetDetail' => ['path' => '/tpadmin/cs_sheet/detail', 'contents' => '/tpadmin/cs_sheet/ajax/detail', 'title' => '送客シート閲覧', 'icon' => 'fa-file-text'],
        'adminPrint' => ['path' => '/tpadmin/print/', 'contents' => '/tpadmin/print/ajax/index', 'title' => '宛名印刷', 'icon' => 'fa-envelope'],
    ];
    //======================================================================
    // グローバルナビゲーション一覧
    //======================================================================
    public const gNav = [
        'adminCs' => self::sitemap['adminCs'],
        'adminCsEdit' => self::sitemap['adminCsEdit'],
        'adminCsSeet' => self::sitemap['adminCsSeet'],
        'adminPrint' => self::sitemap['adminPrint'],
    ];
}
