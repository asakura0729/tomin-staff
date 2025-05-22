<?php
//======================================================================
// ファイル生成・削除
//======================================================================
class appFuncEditFile
{
    //-----------------------------------------------------
    // ファイル生成
    //-----------------------------------------------------
    public static function createFile($filepath, $result)
    {
        $dir = dirname($filepath);
        if (!is_dir($dir)) {
            /*分岐：ディレクトリ無し*/
            mkdir($dir, 0755, true);
        }
        file_put_contents($filepath, $result);
    }
    //-----------------------------------------------------
    // ファイル容量取得
    //-----------------------------------------------------
    public static function dir_size($dir): int
    {
        $handle = opendir($dir);
        $mas = 0;
        while ($file = readdir($handle)) {
            if ($file != '..' && $file != '.' && !is_dir($dir . '/' . $file)) {
                $mas += filesize($dir . '/' . $file);
            } else if (is_dir($dir . '/' . $file) && $file != '..' && $file != '.') {
                $mas += self::dir_size($dir . '/' . $file);
            }
        }
        return $mas;
    }
    //-----------------------------------------------------
    // 単位変換
    //-----------------------------------------------------
    function byte_format($size = 0): string
    {
        $units = ['byte', 'KB', 'MB', 'GB', 'TB'];
        for ($i = 0; 1024 < $size; $i++) {
            $size /= 1024;
        }
        return round($size) . ' ' . $units[$i];
    }
}
