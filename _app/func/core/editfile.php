<?php
//======================================================================
// ファイル生成・削除
//======================================================================
class appFuncEditFile
{
    //-----------------------------------------------------
    // ファイル生成
    //-----------------------------------------------------
    public static function createFile($result, $filepath)
    {
        // ファイルを書き込みモードで開く
        $file_handle = fopen($filepath, "w");
        // ファイルへデータを書き込み
        fwrite($file_handle, $result);
        // ファイルを閉じる
        fclose($file_handle);
    }
    //-----------------------------------------------------
    // 画像アップロード
    //-----------------------------------------------------
    public static function uploadGroupFile($files, $imgDir): array
    {
        //参照：https://qiita.com/ryo-futebol/items/11dea44c6b68203228ff
        $result = [];
        foreach ($files as $key => $value) {
            if (!empty($value['name'])) {
                //アップロードステータスを定義（拡張子NG：0／アップロード失敗：1／アップロード成功：2)
                //初期値：0
                $status = 0;
                //アップロードされたファイルの拡張子を取得
                $extension = substr(strrchr($value['name'], '.'), 1);
                //サーバに保存するファイル名を設定
                $fileName = $key . '.' . $extension;
                //許容される拡張子一覧
                $extensionList = ['jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG'];
                //判断：拡張子チェック
                if (in_array($extension, $extensionList)) {
                    //分岐A：拡張子チェック...OK
                    //古いファイルを削除
                    foreach ($extensionList as $extensionListValue) {
                        $delFile = $imgDir . $key . '.' . $extensionListValue;
                        if (file_exists($delFile)) {
                            unlink($delFile);
                        }
                    }
                    //imagesディレクトリにファイル保存
                    move_uploaded_file($value['tmp_name'], $imgDir . $fileName);
                    //ファイルの存在確認
                    if (file_exists($imgDir . $fileName)) {
                        //アップロード成功
                        $status = 2;
                    } else {
                        //アップロード失敗
                        $status = 1;
                    }
                } else {
                    //分岐B：拡張子チェック...NG
                    $status = 0;
                }
                $result[] = ['name' => $value['name'], 'rename' => $fileName, 'status' => $status];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 画像アップロード後の確認
    //-----------------------------------------------------
    public static function uploadErrorMsg($errMsg, $valueName, $valueStatus): string
    {
        $string = $errMsg;
        $strHead = '【エラー】アップロードに失敗しました（ファイル名：' . $valueName . ')<br>';
        switch ($valueStatus) {
            case '0':
                $string .= $strHead . 'アップロードした画像の拡張子が不適切です。jpgかpng形式でお願いいたします。<hr>';
                break;
            case '1':
                $loadavg = 0;
                if (function_exists('sys_getloadavg')) {
                    $getloadavg = sys_getloadavg();
                    $loadavg = intval($getloadavg[0]);
                }
                if ($loadavg >= 10) {
                    $string .= $strHead . 'お名前.comのサーバが異常に重いです。数分時間を置いてもう一度やり直して下さい。（ロードアベレージ：' . $loadavg . '）<hr>';
                } else if ($loadavg >= 3) {
                    $string .= $strHead . 'お名前.comのサーバが重い様子。数秒時間を置いてもう一度やり直して下さい。（ロードアベレージ：' . $loadavg . '）<hr>';
                } else {
                    $string .= $strHead . 'もう一度やり直して下さい<hr>';
                }
                break;
        }
        return $string;
    }
    //-----------------------------------------------------
    // 画像リサイズ
    //-----------------------------------------------------
    public static function imgResize($img, $size = 900): string
    {
        //https://shinobit.net/archives/261
        //画像の有無を確認
        if (file_exists($img)) {
            $image = getimagesize($img);
            $output = $img;
        } else {
            return 'noResize';
        }
        //画像のサイズを確認
        if ($image[0] <= $size) {
            return 'noResize';
        }
        /*画像の傾きを検知*/
        $rotate = 0;
        $exif = @exif_read_data($img, 'IFD0'); //Exif読み込み
        if (false !== $exif) {
            $orientation = $exif['Orientation']; //Orientation取得←今回テーマ
            switch ($orientation) { //Orientationの値によって分ける
                case 1:
                    $rotate = 0; //1はそのまま
                    break;
                case 3:
                    $rotate = 180; //3は180度回転
                    break;
                case 6:
                    $rotate = 270; //6は右に90度(左に270度)
                    break;
                case 8:
                    $rotate = 90; //8は右に270度(左に90度)
                    break;
                default:
                    $rotate = 0; //他は無視
            }
        }
        if ($image['mime'] == 'image/png') {
            $newimg = imagecreatefrompng($img);
            //imagescaleという便利な関数があったぜ
            $newimg = imagescale($newimg, $size);
            //画像を回転（※朝倉オリジナル）
            $newimg = imagerotate($newimg, $rotate, 0);
            //ブレンドモードを無効にする
            imagealphablending($newimg, false);
            //完全なアルファチャネル情報を保存するフラグをonにする
            imagesavealpha($newimg, true);
            //ファイルとして書き出し
            imagepng($newimg, $output);
            imagedestroy($newimg);
        } else if ($image['mime'] == 'image/jpeg') {
            $newimg = imagecreatefromjpeg($img);
            $newimg = imagescale($newimg, $size);
            $newimg = imagerotate($newimg, $rotate, 0);
            imagejpeg($newimg, $output);
            imagedestroy($newimg);
        }
        return 'resize';
    }
    //-----------------------------------------------------
    // フォルダ削除
    //-----------------------------------------------------
    public static function rmdirAll($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            // ファイルかディレクトリによって処理を分ける
            if (is_dir("$dir/$file")) {
                // ディレクトリなら再度同じ関数を呼び出す
                self::rmdirAll("$dir/$file");
            } else {
                // ファイルなら削除
                unlink("$dir/$file");
                //echo "ファイル:" . $dir . "/" . $file . "を削除n";
            }
        }
        // 指定したディレクトリを削除
        //echo "ディレクトリ:" . $dir . "を削除n";
        return rmdir($dir);
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
