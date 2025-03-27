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
    //======================================================================
    // サイトマップ
    //======================================================================
    public const pagePath = 'path';
    public const pageContents = 'contents';
    public const pageTitle = 'title';
    public const pageIcon = 'icon';
    public const sitemap = [
        'login' => [self::pagePath => '/login/', self::pageContents => null, self::pageTitle => 'ログイン'],
        'admin' => [self::pagePath => '/tpadmin/', self::pageContents => '/tpadmin/top/ajax/top', self::pageTitle => '管理画面', self::pageIcon => 'fa-home'],
        'adminAjaxCstable' => [self::pagePath => null, self::pageContents => '/tpadmin/ajax/cs-table', self::pageTitle => '対応ログ一覧', self::pageIcon => ''],
        'adminCsIndex' => [self::pagePath => '/tpadmin/cs/', self::pageContents => '/tpadmin/cs/ajax/index', self::pageTitle => '対応ログ一覧', self::pageIcon => 'fa-list-ol'],
        'adminCsEdit' => [self::pagePath => '/tpadmin/cs/edit', self::pageContents => '/tpadmin/cs/ajax/edit', self::pageTitle => '対応ログ作成', self::pageIcon => 'fa-pencil'],
        'adminCsSeet' => [self::pagePath => '/tpadmin/cs_sheet/', self::pageContents => '/tpadmin/cs_sheet/ajax/index', self::pageTitle => '送客シート一覧', self::pageIcon => 'fa-file-text'],
        'adminCsSeetEdit' => [self::pagePath => '/tpadmin/cs_sheet/edit', self::pageContents => '/tpadmin/cs_sheet/ajax/edit', self::pageTitle => '送客シート編集', self::pageIcon => 'fa-file-text'],
        'adminCsSeetDetail' => [self::pagePath => '/tpadmin/cs_sheet/detail', self::pageContents => '/tpadmin/cs_sheet/ajax/detail', self::pageTitle => '送客シート閲覧', self::pageIcon => 'fa-file-text'],
        'adminPrint' => [self::pagePath => '/tpadmin/print/', self::pageContents => '/tpadmin/print/ajax/index', self::pageTitle => '宛名印刷', self::pageIcon => 'fa-envelope'],
    ];
    //======================================================================
    // グローバルナビゲーション
    //======================================================================
    public const gNav = [
        'adminCsIndex' => self::sitemap['adminCsIndex'],
        'adminCsEdit' => self::sitemap['adminCsEdit'],
        'adminCsSeet' => self::sitemap['adminCsSeet'],
        'adminPrint' => self::sitemap['adminPrint'],
    ];
}
