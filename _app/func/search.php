<?php
/*======================================================================

サイト内検索

======================================================================*/
class appFuncSearch
{
    /*キーワードが記入されているかチェックする*/
    public static function checkWords($words)
    {
        $words = trim($words);
        $words = str_replace('　', '', $words);
        if ($words == '') {
            return false;
        } else {
            return true;
        }
    }

    /*配列から複数のLIKE演算子を生成*/
    public static function words($words = null, $sqlWhere = []): string
    {
        $result = ' WHERE ';
        $explodeWords = explode(" ", $words);
        foreach ($explodeWords as $explodeWordsKey => $explodeWordsValue) {
            $result .= '(';
            foreach ($sqlWhere as $sqlWhereKey => $sqlWhereValue) {
                $result .= $sqlWhereValue . ' LIKE "%' . $explodeWordsValue . '%"';
                if ($sqlWhereKey != array_key_last($sqlWhere)) {
                    $result .= ' or ';
                }
            }
            $result .= ')';
            if ($explodeWordsKey != array_key_last($explodeWords)) {
                $result .= ' and ';
            }
        }
        return $result;
    }
}
