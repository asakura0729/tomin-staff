<?php
//======================================================================
// 文字列を作成・加工して新しい文字列を返します
//======================================================================
class appFuncString
{
    public const textNone = '---';
    //-----------------------------------------------------
    // #を除去して描画
    //-----------------------------------------------------
    public static function exclusionHash(string $str): string
    {
        return str_replace("#", "", $str);
    }
    //-----------------------------------------------------
    // 改行を除去して描画
    //-----------------------------------------------------
    public static function removeNewlines(string $str): string
    {
        return str_replace(["\r\n", "\n", "\r"], '', $str);
    }
    //-----------------------------------------------------
    // 文字列が0文字以下の場合、代替テキストを返す
    //-----------------------------------------------------
    public static function strlenString(string $string, string $strFalse = ""): string
    {
        if (strlen($string) > 0) {
            return $string;
        } else {
            return $strFalse;
        }
    }
    //-----------------------------------------------------
    // 文字列に対し、HTML属性に安全に埋め込むための変換を行う
    //-----------------------------------------------------
    public static function convertTextForDataAttribute(string $text): string
    {
        return htmlspecialchars(
            str_replace(["\r\n", "\n", "\r"], "&#10;", $text),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );
    }
    //-----------------------------------------------------
    // bool値のtrue、falseで異なる文字列を描画
    //-----------------------------------------------------
    public static function boolString($bool, string $strTrue = "", string $strFalse = ""): string
    {
        if ($bool === true) {
            return $strTrue;
        } else {
            return $strFalse;
        }
    }
    //-----------------------------------------------------
    // 値に応じたテキストを返す
    //-----------------------------------------------------
    public static function switchString(string $string, array $key, array $results, string $defaultResult = ""): string
    {
        $result = $defaultResult;
        foreach ($key as $index => $value) {
            if ($string === $value) {
                $result = $results[$index];
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 文字列に強制的に文字を差し込む
    //-----------------------------------------------------
    public static function addText($str, $val, $add): string
    {
        $str1 = mb_substr($str, 0, $val);
        $str2 = mb_substr($str, $val);
        $result = $str1 . $add . $str2;
        return $result;
    }
    //-----------------------------------------------------
    // 数値にコンマを入れる
    //-----------------------------------------------------
    public static function omitInt($int): string
    {
        $result = $int;
        $int = intval($int);
        if ($int != 0) {
            $result = number_format($int);
        }
        return $result;
    }
    //-----------------------------------------------------
    // 数値のみを抜き出す
    //-----------------------------------------------------
    public static function getInt($str): string
    {
        $result = preg_replace('/\D/', '', $str);
        return $result;
    }
    //-----------------------------------------------------
    // ランダム文字列を返す
    //-----------------------------------------------------
    public static function randomText(): string
    {
        $now = microtime(true);
        $result = (int)(($now - (int)$now) * 1000);
        $result .= rand(10000, 99999);
        return $result;
    }
    //-----------------------------------------------------
    // 電話番号のフォーマット
    //-----------------------------------------------------
    public static function formatPhoneNumber($number): string
    {
        $digits = preg_replace('/\D/', '', $number);
        if (preg_match('/^0[789]0\d{8}$/', $digits)) {
            return preg_replace('/^(0[789]0)(\d{4})(\d{4})$/', '$1-$2-$3', $digits);
        }
        return $number;
    }
    //-----------------------------------------------------
    // 文字列を切り出し
    //-----------------------------------------------------
    public static function extract($str, $val): string
    {
        $result = strip_tags($str);
        $result = trim($result);
        $result = mb_substr($result, 0, $val);
        $mb_strlen = mb_strlen($result);
        if ($mb_strlen > $val - 1) {
            $result .= '...';
        }
        return $result;
    }
}
