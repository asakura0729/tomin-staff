<?php
//======================================================================
// 圧縮・軽量化関係
//======================================================================
class appFuncMinify
{

    public static function minifySourceStart()
    {
        ob_start();
    }
    
    public static function minifySourceEnd()
    {
        $buffer = ob_get_clean();
        $minified_html = self::minifyStr($buffer);
        echo $minified_html;
    }

    public static function minifyStr($html): string
    {
        return preg_replace([
            '/\>[^\S ]+/s',  // タグの後の不要な空白を削除
            '/[^\S ]+\</s',  // タグの前の不要な空白を削除
            '/(\s)+/s'        // 複数の空白を1つにする
        ], ['>', '<', '\\1'], $html);
    }
}
