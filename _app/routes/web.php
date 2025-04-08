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
    public const pageRoute = 'route';
    public const pageIcon = 'icon';
    public const sitemap = [
        'login' => [self::pagePath => '/login/', self::pageContents => null, self::pageTitle => 'ログイン'],
        'admin' => [self::pagePath => '/tpadmin/', self::pageContents => '/ajax/top/index', self::pageTitle => '管理画面', self::pageIcon => 'fa-home'],
        'adminAjaxCstable' => [self::pagePath => null, self::pageContents => '/ajax/cs_table', self::pageTitle => '対応ログ一覧', self::pageRoute => [], self::pageIcon => ''],
        'adminAjaxCsedit' => [self::pagePath => null, self::pageContents => '/ajax/form_edit_cs', self::pageTitle => '編集', self::pageRoute => [], self::pageIcon => ''],
        'adminCsIndex' => [self::pagePath => '/tpadmin/cs/', self::pageContents => '/ajax/cs/index', self::pageTitle => '対応ログ一覧', self::pageRoute => [], self::pageIcon => 'fa-list-ol'],
        'adminCsEdit' => [self::pagePath => '/tpadmin/cs/edit', self::pageContents => '/ajax/cs/edit', self::pageTitle => '対応ログ編集', self::pageRoute => ['adminCsIndex'], self::pageIcon => 'fa-pencil'],
        'adminCsList_invalid' => [self::pagePath => '/tpadmin/cs/list_invalid', self::pageContents => '/ajax/cs/list_invalid', self::pageTitle => '無効電話一覧', self::pageRoute => ['adminCsIndex'], self::pageIcon => 'fa-list-ol'],
        'adminCsList_check' => [self::pagePath => '/tpadmin/cs/list_check', self::pageContents => '/ajax/cs/list_check', self::pageTitle => 'ログチェック一覧', self::pageRoute => ['adminCsIndex'], self::pageIcon => 'fa-list-ol'],
        'adminCsSeet' => [self::pagePath => '/tpadmin/cs_sheet/', self::pageContents => '/ajax/cs_sheet/index', self::pageTitle => '送客シート一覧', self::pageRoute => [], self::pageIcon => 'fa-file-text'],
        'adminCsSeetDetail' => [self::pagePath => '/tpadmin/cs_sheet/detail', self::pageContents => '/ajax/cs_sheet/detail', self::pageTitle => '送客シート閲覧', self::pageRoute => ['adminCsSeet'], self::pageIcon => 'fa-file-text'],
        'adminCsSeetEdit' => [self::pagePath => '/tpadmin/cs_sheet/edit', self::pageContents => '/ajax/cs_sheet/edit', self::pageTitle => '送客シート編集', self::pageRoute => ['adminCsSeet'], self::pageIcon => 'fa-file-text'],
        'adminPrint' => [self::pagePath => '/tpadmin/print/', self::pageContents => '/ajax/print/index', self::pageTitle => '宛名印刷', self::pageRoute => [], self::pageIcon => 'fa-envelope'],
    ];
    //======================================================================
    // グローバルナビゲーション
    //======================================================================
    public const gNav = [
        'adminCsEdit' => self::sitemap['adminCsEdit'],
        'adminCsIndex' => self::sitemap['adminCsIndex'],
        'adminCsList_invalid' => self::sitemap['adminCsList_invalid'],
        'adminCsList_check' => self::sitemap['adminCsList_check'],
        'adminCsSeet' => self::sitemap['adminCsSeet'],
        'adminPrint' => self::sitemap['adminPrint'],
    ];
}
