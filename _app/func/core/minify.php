<?php
//======================================================================
// 圧縮・軽量化関係
//======================================================================
class appFuncMinify
{
    //-----------------------------------------------------
    // HTML圧縮開始
    //-----------------------------------------------------
    public static function minifySourceStart(bool $bool = true)
    {
        if ($bool === true) {
            /*分岐：HTML圧縮の設定有効*/
            ob_start();
        }
    }
    //-----------------------------------------------------
    // HTML圧縮終了
    //-----------------------------------------------------
    public static function minifySourceEnd(bool $bool = true)
    {
        if ($bool === true) {
            /*分岐：HTML圧縮の設定有効*/
            $buffer = ob_get_clean();
            $minified_html = self::minifyStr($buffer);
            echo $minified_html . "\n\n";
        }
    }
    //-----------------------------------------------------
    // HTML圧縮処理
    //-----------------------------------------------------
    public static function minifyStr($html): string
    {
        return preg_replace([
            '/\>[^\S ]+/s',  // タグの後の不要な空白を削除
            '/[^\S ]+\</s',  // タグの前の不要な空白を削除
            '/(\s)+/s'       // 複数の空白を1つにする
        ], ['>', '<', '\\1'], $html);
    }
    //-----------------------------------------------------
    // 速度計測
    //-----------------------------------------------------
    public static function microtime(bool $cache = false)
    {
        appConfigPage::$microtimeEnd = microtime(true);
        $microtime = appConfigPage::$microtimeEnd - appConfigPage::$microtimeStart;
        $path = appConfigPage::$path;
        if ($cache === true) {
            echo '<script>console.log("cache:' . $path . ',time:' . $microtime . '");</script>';
        } else {
            echo '<script>console.log("cache:none,time:' . $microtime . '");</script>';
        }
    }
}
