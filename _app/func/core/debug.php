<?php
//======================================================================
// デバッグ処理
//======================================================================
class appFuncDebug
{
    //-----------------------------------------------------
    // 関数：エラーレポート
    //-----------------------------------------------------
    public static function error_report($bool = true)
    {
        if ($bool === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
            set_error_handler(function ($severity, $message, $file, $line) {
                throw new ErrorException($message, 0, $severity, $file, $line);
            });
            set_exception_handler(function ($exception) {
                echo "Exception: ", $exception->getMessage(), "\n";
                exit(1);
            });
        }
    }
}
