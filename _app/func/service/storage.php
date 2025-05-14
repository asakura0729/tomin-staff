<?php
//======================================================================
// ストレージ保存用ファイルの作成
//======================================================================
class appFuncStorage
{
    public const storagePath = __DIR__ . '/../../../_storage';
    //-----------------------------------------------------
    // キャッシュファイルのパスを作成
    //-----------------------------------------------------
    public static function createPath(string $str, string $add = ""): string
    {
        return  self::storagePath . $str . $add . '.php';
    }
    //-----------------------------------------------------
    // キャッシュファイル読込
    //-----------------------------------------------------
    public static function load($str)
    {
        $cacheFile = self::createPath($str);
        if (file_exists($cacheFile)) {
            readfile($cacheFile);
        }
    }
    //-----------------------------------------------------
    // 権限別キャッシュファイルのパスを作成
    //-----------------------------------------------------
    public static function createPathAuthority(): string
    {
        try {
            $authority = $_SESSION[appConfigSession::authority];
            $add = '-' . $authority;
            return  self::createPath(appConfigPage::$path, $add);
        } catch (PDOException $e) {
            echo 'Error:' . $e->getMessage();
            exit;
        }
    }
    //-----------------------------------------------------
    // 権限別キャッシュファイル生成（開始）
    //-----------------------------------------------------
    public static function start()
    {
        appConfigPage::$microtimeStart = microtime(true);
        if (appConfigSite::cache === true) {
            $cacheFile = self::createPathAuthority();
            if (file_exists($cacheFile)) {
                /*分岐：キャッシュファイルあり*/
                readfile($cacheFile);
                appFuncMinify::microtime(true);
                exit;
            } else {
                /*分岐：キャッシュファイルなし*/
                ob_start();
            }
        }
    }
    //-----------------------------------------------------
    // 権限別キャッシュファイル生成（終了）
    //-----------------------------------------------------
    public static function end()
    {
        if (appConfigSite::cache === true) {
            $cacheFile = self::createPathAuthority();
            if (!file_exists($cacheFile)) {
                /*分岐：キャッシュファイルなし*/
                $outputHtml = ob_get_clean();
                appFuncEditFile::createFile($cacheFile, $outputHtml);
                echo $outputHtml;
            }
        }
        appFuncMinify::microtime(false);
    }
}
