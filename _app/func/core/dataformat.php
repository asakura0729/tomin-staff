<?php
//======================================================================
// データ整形
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
                switch ($rowInput) {
                    case 'datetime-local':
                        if ($value != null) {
                            $date = new DateTime($value);
                            $value = $date->format('Y年m月d日 H:i');
                        } else {
                            $value = '---';
                        }
                        break;
                    case 'date':
                        if ($value != null) {
                            $date = new DateTime($value);
                            $value = $date->format('Y年m月d日');
                        } else {
                            $value = '---';
                        }
                        break;
                    case 'number':
                        if ($value != '') {
                            $value = number_format($value);
                        }
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
            if (isset($post[$inputName])) {
                /*判断：テーブルに定義された値がPOSTに存在*/
                $dbpost[$inputName] = $post[$inputName];
                switch ($type) {
                    case 'date':
                        if ($dbpost[$inputName] != '') {
                            $date = new DateTime($dbpost[$inputName]);
                            $dbpost[$inputName] = $date->format('Y-m-d');
                        } else {
                            $dbpost[$inputName] = null;
                        }
                        break;
                    case 'datetime':
                        if ($dbpost[$inputName] != '') {
                            $date = new DateTime($dbpost[$inputName]);
                            $dbpost[$inputName] = $date->format('Y-m-d H:i:s');
                        } else {
                            $dbpost[$inputName] = null;
                        }
                        break;
                    case 'DECIMAL(10,2)':
                        $dbpost[$inputName] = preg_replace('/[^\d-]/', '', $dbpost[$inputName]);
                        break;
                    case 'INT(4)':
                        $dbpost[$inputName] = intval($dbpost[$inputName]);
                        break;
                    default:
                        $dbpost[$inputName] = $dbpost[$inputName];
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
    public static function bindParam($database, array $post): array
    {
        $result = [];
        $table = $database::table;
        foreach ($table as $tableRow) {
            $rowName = $tableRow[appConfigDatabase::row];
            if ($tableRow[appConfigDatabase::rowConstraints] === appConfigDatabase::primaryKey) {
                /*判断：値がPRIMARY KEY*/
                continue;
            }
            if (isset($post[$rowName])) {
                /*判断：テーブルに定義された値がPOSTに存在*/
                $paramKey = ':' . $rowName;
                $result[$paramKey] = $post[$rowName];
            }
        }
        return $result;
    }
}
