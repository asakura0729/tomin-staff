<?php
//======================================================================
// POST／GETデータを整形して配列を返します
//======================================================================
class appFuncDataformat
{
    //-----------------------------------------------------
    // DB取得データ整形
    //-----------------------------------------------------
    public static function dbResult(array $dbResult, array $table = []): array
    {
        $result = [];
        foreach ($table as $key => $value) {
            $result[$key] = "";
        }
        if (count($dbResult) > 0) {
            foreach ($dbResult as $key => $value) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // DB取得データ整形（文字列で整形）
    //-----------------------------------------------------
    public static function dbResultStr(array $dbResult, array $table): array
    {
        $result = [];
        foreach ($dbResult as $rowName => $value) {
            $rowInput = "";
            if (isset($table[$rowName])) {
                $rowInput = $table[$rowName][appConfigDatabase::rowInput];
                if ($table[$rowName][appConfigDatabase::rowConstraints] === appConfigDatabase::primaryKey) {
                    $result[$rowName] = $value;
                    continue;
                }
                if ($value === null || $value === '') {
                    $result[$rowName] = '';
                    continue;
                }
                switch ($rowInput) {
                    case 'datetime-local':
                        $date = new DateTime($value);
                        $value = $date->format('Y年m月d日 H:i');
                        break;
                    case 'date':
                        $date = new DateTime($value);
                        $value = $date->format('Y年m月d日');
                        break;
                    case 'number':
                        $value = number_format($value);
                        break;
                    case 'time':
                        $date = new DateTime($value);
                        $value = $date->format('H:i');
                        break;
                    case 'select':
                        $value = self::selectmenu($table, $rowName, $value);
                        break;
                    case 'textarea':
                        $value = nl2br($value);
                        break;
                }
            }
            $result[$rowName] = $value;
        }
        return $result;
    }
    //-----------------------------------------------------
    // セレクトメニューの値を文字列で取得
    //-----------------------------------------------------
    public static function selectmenu($table, $rowName, $value): string
    {
        $result = "";
        if (!isset($table[$rowName]['value'])) {
            return $result;
        }
        $selectItem = $table[$rowName]['value'];
        foreach ($selectItem['item'] as $itemKey => $item) {
            if ($value === (string) $itemKey) {
                if (isset($selectItem['string'])) {
                    $result = $item[$selectItem['string']];
                } else {
                    $result = $item;
                }
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 複数のPOSTデータを整形
    //-----------------------------------------------------
    public static function dbPostMultiple(array $post, string $key): array
    {
        $result = [];
        $count = 0;
        if (isset($post[$key])) {
            foreach ($post[$key] as $keyValue) {
                foreach ($post as $inputName => $inputValue) {
                    $result[$count][$inputName] = $post[$inputName][$count];
                }
                $count++;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // データベースに追加するValue値を設定
    //-----------------------------------------------------
    public static function dbPostParam($database, array $post): array
    {
        $dbpost = [];
        $table = $database::table;
        $primaryKey = $database::primaryKey;
        foreach ($table as $tableRow) {
            $inputName = $tableRow[appConfigDatabase::row];
            $type = $tableRow[appConfigDatabase::rowType];
            if ($tableRow[appConfigDatabase::rowConstraints] === appConfigDatabase::primaryKey) {
                /*判断：値がPRIMARY KEY*/
                continue;
            }
            if (array_key_exists($inputName, $_POST)) {
                /*判断：テーブルに定義された値がPOSTに存在*/
                if ($post[$inputName] === null) {
                    $dbpost[$inputName] = null;
                    continue;
                }
                switch ($type) {
                    case 'date':
                        if ($post[$inputName] != '') {
                            $date = new DateTime($post[$inputName]);
                            $dbpost[$inputName] = $date->format('Y-m-d');
                        } else {
                            $dbpost[$inputName] = null;
                        }
                        break;
                    case 'datetime':
                        if ($post[$inputName] != '') {
                            $date = new DateTime($post[$inputName]);
                            $dbpost[$inputName] = $date->format('Y-m-d H:i:s');
                        } else {
                            $dbpost[$inputName] = null;
                        }
                        break;
                    case 'DECIMAL(10,2)':
                        if ($post[$inputName] != '') {
                            $dbpost[$inputName] = preg_replace('/[^\d-]/', '', $post[$inputName]);
                        } else {
                            $dbpost[$inputName] = null;
                        }
                        break;
                    case 'INT(4)':
                        $dbpost[$inputName] = intval($post[$inputName]);
                        break;
                    default:
                        $dbpost[$inputName] = $post[$inputName];
                        break;
                }
            }
        }
        $date = date('Y-m-d H:i:s');
        $dbpost['update_date'] = $date;
        $dbpost['update_by'] = $_SESSION[appConfigSession::userId];
        if ($post[$primaryKey] === '') {
            /*分岐：新規*/
            $dbpost['insert_date'] = $date;
            $dbpost['insert_by'] = $_SESSION[appConfigSession::userId];
            $dbpost['delete_flg'] = appConfigDatabase::deleteFlgFalse;
        }
        return $dbpost;
    }

    //-----------------------------------------------------
    // バインドパラメータ作成
    //-----------------------------------------------------
    public static function bindParam(array $post): array
    {
        $result = [];
        foreach ($post as $key => $value) {
            if ($key === appConfigDatabase::primaryKey) {
                /*判断：値がPRIMARY KEY*/
                continue;
            }
            $paramKey = ':' . $key;
            $result[$paramKey] = $value;
        }
        return $result;
    }
}
