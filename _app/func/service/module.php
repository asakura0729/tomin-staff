<?php
//======================================================================
// モジュールを読込んで部分的に値を変える
//======================================================================
class appFuncModule
{
    public const modulePath = __DIR__ . '/../../../_module'; //モジュールのパス
    //-----------------------------------------------------
    // PHPファイルの読み込み
    //-----------------------------------------------------
    public static function include(string $path, array $option = [])
    {
        include $path;
    }
    //-----------------------------------------------------
    // POPOVER
    //-----------------------------------------------------
    public static function popover(string $popover): string
    {
        $result = "";
        if ($popover != '') {
            $result = 'data-container="' . appConfigSite::pageMain . '" data-toggle="popover" data-placement="bottom" data-content="' . $popover . '"';
        }
        return $result;
    }
    //-----------------------------------------------------
    // ボタン要素
    //-----------------------------------------------------
    public static function btn(string $moduleName, array $option = [])
    {
        $addClass = appFuncArray::issetKey($option, 'css', ''); //追加したいCSS
        $title = appFuncArray::issetKey($option, 'title', ''); //表題
        $addParam = appFuncArray::issetKey($option, 'add', ''); //カスタム要素
        $disabled = appFuncArray::issetKey($option, 'disabled', false); //ボタン有効・無効（true...ボタン無効）
        $popover =  self::popover(appFuncArray::issetKey($option, 'popover', '')); //リンク無効時に表示するテキスト
        include self::modulePath . '/btn/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // コンポーネント
    //-----------------------------------------------------
    public static function component(string $moduleName, array $option = [])
    {
        $addClass = appFuncArray::issetKey($option, 'css', ''); //追加したいCSS
        $title = appFuncArray::issetKey($option, 'title', ''); //表題
        $addParam = appFuncArray::issetKey($option, 'add', ''); //カスタム要素
        include self::modulePath . '/component/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // CSS
    //-----------------------------------------------------
    public static function css(string $moduleName, array $option = [])
    {
        include self::modulePath . '/css/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // 入力フォーム
    //-----------------------------------------------------
    public static function form(string $moduleName, string $inputValue = "", array $option = [])
    {
        $title = appFuncArray::issetKey($option, 'title', ''); //入力フォームのタイトル
        $inputName = appFuncArray::issetKey($option, 'inputName', 'text'); //入力フォームの名称
        $inputType = appFuncArray::issetKey($option, 'inputType', 'text'); //入力フォームの種類
        $selectItem = appFuncArray::issetKey($option, 'selectItem', []); //セレクトメニュー：選択する配列
        $selectItemString = appFuncArray::issetKey($option, 'selectItemString', ''); //↑で使用する配列が連想配列の場合、表示する文字列を指定
        $selectItemNoValue = appFuncArray::issetKey($option, 'selectItemNoValue', false); //セレクトメニュー：「値未指定」の表記
        $editFlg = appFuncArray::issetKey($option, 'editFlg', true); //編集可・不可
        $maxlength = appFuncArray::issetKey($option, 'maxlength', ''); //最大文字数
        $addParam = appFuncArray::issetKey($option, 'add', ''); //追加要素(ID、data属性、onClick属性など)
        if ($inputType === 'text' && $maxlength != '') {
            $addParam .= ' maxlength="' . $maxlength . '"';
        }
        include self::modulePath . '/form/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // 入力フォーム(DB)
    //-----------------------------------------------------
    public static function dbForm(string $tableRow, array $dbConfig = [])
    {
        if ($tableRow === '' || $dbConfig === []) {
            echo "---";
        }
        $moduleName = $dbConfig['moduleName'];
        $dbTable = appFuncArray::issetKey($dbConfig, 'dbTable', []);
        $dbResult = appFuncArray::issetKey($dbConfig, 'dbResult', []);
        $editFlg = appFuncArray::issetKey($dbConfig, 'editFlg', false);
        $inputType = appFuncArray::issetKey($dbConfig, 'inputType', $dbTable[$tableRow]['input']);
        $maxlength = appFuncString::getInt($dbTable[$tableRow]['type']);
        $addParam = appFuncArray::issetKey($dbConfig, 'add', '');
        $selectItem = [];
        $selectItemString = "";
        $selectItemNoValue = appFuncArray::issetKey($dbConfig, 'selectItemNoValue', false);
        if (isset($dbTable[$tableRow]['value']['item'])) {
            $selectItem = $dbTable[$tableRow]['value']['item'];
            if (isset($dbTable[$tableRow]['value']['string'])) {
                $selectItemString = $dbTable[$tableRow]['value']['string'];
            }
        }
        return self::form(
            $moduleName,
            appFuncArray::issetKey($dbResult, $tableRow, ''),
            [
                'title' => $dbTable[$tableRow]['comment'],
                'inputName' => $tableRow,
                'inputType' => $inputType,
                'selectItem' => $selectItem,
                'selectItemString' => $selectItemString,
                'selectItemNoValue' => $selectItemNoValue,
                'editFlg' => $editFlg,
                'maxlength' => $maxlength,
                'add' => $addParam
            ]
        );
    }
    //-----------------------------------------------------
    // 見出し
    //-----------------------------------------------------
    public static function heading(string $moduleName, string $tag, string $title, array $option = [])
    {
        $addClass = appFuncArray::issetKey($option, 'css', ''); //追加したいCSS
        $icon = appFuncArray::issetKey($option, 'icon', ''); //追加したいアイコン
        $addParam = appFuncArray::issetKey($option, 'add', ''); //カスタム要素
        include self::modulePath . '/heading/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // リンク
    //-----------------------------------------------------
    public static function link(string $moduleName, array $sitemapData, array $option = [])
    {
        $title = appFuncArray::issetKey($option, 'title', $sitemapData['title']); //タイトル
        $queryParam = appFuncArray::issetKey($option, 'queryParam', ''); //追加したいクエリパラメータ
        $disabled = appFuncArray::issetKey($option, 'disabled', false); //リンク有効・無効（true...リンク無効）
        $popover =  self::popover(appFuncArray::issetKey($option, 'popover', '')); //リンク無効時に表示するテキスト
        $addClass = appFuncArray::issetKey($option, 'css', ''); //追加したいCSS
        $addParam = appFuncArray::issetKey($option, 'add', ''); //カスタム要素
        $hxTarget = appFuncArray::issetKey($option, 'hxTarget', appConfigSite::pageMain); //データを読み込む対象
        $hxGetFlg = appFuncArray::issetKey($option, 'hxGetFlg', true); //AJAX送信の有無
        $hxPushFlg = appFuncArray::issetKey($option, 'hxPushFlg', true); //URL変更の有無
        $hxLinkOption = ['hxTarget' => $hxTarget, 'hxGetFlg' => $hxGetFlg, 'hxPushFlg' => $hxPushFlg];
        include self::modulePath . '/link/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // モーダル
    //-----------------------------------------------------
    public static function modal(string $moduleName, string $id, array $option = [])
    {
        include self::modulePath . '/modal/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // javascript
    //-----------------------------------------------------
    public static function js(string $moduleName, array $option = [])
    {
        include self::modulePath . '/js/' . $moduleName . '.php';
    }
    //-----------------------------------------------------
    // 文字列
    //-----------------------------------------------------
    public static function string(string $moduleName, string $text, array $option = [])
    {
        include self::modulePath . '/string/' . $moduleName . '.php';
    }
}
