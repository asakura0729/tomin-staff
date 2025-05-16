<?php
//======================================================================
// CRM＞表示や見た目の制御
//======================================================================
class appFuncCrmDisp
{
    public const db = appDatabaseCs::table;
    //-----------------------------------------------------
    // 対応ログ編集画面＞タイトル
    //-----------------------------------------------------
    public static function pageTitleAdd(array $dbResult = []): string
    {
        if ($dbResult[appDatabaseCs::primaryKey] != '') {
            /*分岐1：既存データ*/
            $result = '（依頼者：';
            $result .= appFuncString::strlenString($dbResult['client_name'], $dbResult['client_name'], '---');
            $result .= ' 様）';
        } else {
            /*分岐2：新規作成*/
            $result = '（新規作成）';
        }
        return  $result;
    }
    //-----------------------------------------------------
    // 対応ログ一覧＞テキスト
    //-----------------------------------------------------
    public static function dbResultValue(array $value, string $key, string $inputType): string
    {

        $str = appFuncArray::issetKey($value, $key);
        $css = "";
        if ($inputType != 'textarea') {
            $css = 'text-center';
        }
        if ($str === '') {
            $str = '---';
            $css = 'text-center';
        }
        $result = <<<EOF
        <span class="d-block {$css}">{$str}</span>
        EOF;
        return $result;
    }
    //-----------------------------------------------------
    // 対応ログ一覧＞背景色
    //-----------------------------------------------------
    public static function setBgcolor($value): string
    {
        $result = "bg-white";
        $funeralStatus = $value['dbresult'][self::db['funeral_status']['name']];
        $clientCategory = $value['dbresult'][self::db['client_category']['name']];
        if ($funeralStatus === appConfigStatus::funeral_status['complete']['key']) {
            /*分岐1：報告完了*/
            $result = "bg-gray";
        } elseif (isset(appConfigStatus::clientCategory[$clientCategory])) {
            if ($clientCategory === 'cancel') {
                /*分岐2：顧客カテゴリがキャンセル*/
                $result = "bg-lpink";
            } elseif (appConfigStatus::clientCategory[$clientCategory]['type'] === appConfigStatus::clientCategoryValid) {
                /*分岐3：顧客カテゴリが有効顧客*/
                $result = "bg-lblue";
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 対応ログ一覧＞セルの横幅調整
    //-----------------------------------------------------
    public static function setListRowWidth(string $inputName, string $inputType): string
    {
        $result = "";
        switch ($inputName) {
            case self::db['ensconce_address']['name']:
                $result = '250';
                break;
            case self::db['comment']['name']:
            case self::db['comment_sheet']['name']:
                $result = '400';
                break;
            case self::db['total_price']['name']:
            case self::db['hall_price']['name']:
            case self::db['client_region']['name']:
            case self::db['dec_region']['name']:
                $result = '150';
                break;
            case self::db['post_by']['name']:
            case self::db['delivery_status']['name']:
            case self::db['approval_status']['name']:
            case self::db['funeral_status']['name']:
                $result = '100';
                break;
            default:
                switch ($inputType) {
                    case 'checkbox':
                        $result = "100";
                        break;
                    case 'select':
                    case 'date':
                    case 'textarea':
                        $result = "150";
                        break;
                    case 'datetime-local':
                        $result = '180';
                        break;
                    default:
                        $result = '150';
                        break;
                }
                break;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 対応ログ一覧＞承認ボタン
    //-----------------------------------------------------
    public static function btnApproval($value): array
    {
        $result = [];
        $csId = $value[appDatabaseCs::primaryKey];
        $approvalStatusKey = self::db['approval_status']['name'];
        $approvalStatus = $value['dbresult'][$approvalStatusKey];
        if ($approvalStatus === appConfigStatus::approval_status['complete']['key']) {
            /*分岐1：承認済*/
            $result['title'] = appConfigStatus::approval_status['complete']['name'];
            $result['disabled'] = true;
        } else {
            /*分岐2：未承認*/
            $insertApprovalStatus = appConfigStatus::approval_status['complete']['key'];
            $result['title'] = appConfigStatus::approval_status['progress']['name'];
            $result['add'] = <<<EOF
            data-edit-approval='{"cs_id":"{$csId}","approval_status":"{$insertApprovalStatus}"}'
            EOF;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 対応ログ一覧＞ダウンロード用CSV
    //-----------------------------------------------------
    public static function csv(array $dbResult, array $tableRow): string
    {
        $result = "";
        foreach ($tableRow as $key => $row) {
            if ($key === appDatabaseCs::primaryKey || $row['input'] != '' && $row['input'] != 'hidden') {
                $rowValues[] = $row['comment'];
            }
        }
        $result .= implode(',', $rowValues) . "\n";
        foreach ($dbResult as $value) {
            $rowValues = [];
            foreach ($tableRow as $key => $row) {
                if ($key === appDatabaseCs::primaryKey || $row['input'] != '' && $row['input'] != 'hidden') {
                    $cell = strip_tags($value[$key]);
                    $cell = str_replace(["\r\n", "\r", "\n"], '', $cell);
                    if (strpos($cell, ',') !== false || strpos($cell, '"') !== false) {
                        $cell = '"' . str_replace('"', '""', $cell) . '"';
                    }
                    $rowValues[] = $cell;
                }
            }
            $result .= implode(',', $rowValues) . "\n";
        }
        return $result;
    }
    //-----------------------------------------------------
    // 入力フォーム＞横幅調整
    //-----------------------------------------------------
    public static function setFormRowWidth($inputName, $inputType): string
    {
        switch ($inputType) {
            case 'checkbox':
                $colClass = 'w-100px';
                break;
            case 'select':
            case 'date':
                $colClass = 'w-150px';
                break;
            case 'datetime-local':
                $colClass = 'w-180px';
                break;
            case 'textarea':
                $colClass = 'w-200px';
                break;
            default:
                $colClass = 'w-200px';
        }
        switch ($inputName) {
            case self::db['comment']['name']:
            case self::db['comment_sheet']['name']:
                $colClass = 'w-600px';
                break;
            case self::db['client_category']['name']:
                $colClass = 'w-200px';
                break;
            case self::db['client_name']['name']:
            case self::db['client_tel']['name']:
            case self::db['client_region']['name']:
            case self::db['dec_name']['name']:
            case self::db['dec_region']['name']:
            case self::db['dec_relation']['name']:
                $colClass = 'w-150px';
                break;
            case self::db['delivery_status']['name']:
            case self::db['approval_status']['name']:
                $colClass = 'w-100px';
                break;
        }
        return $colClass;
    }
    //-----------------------------------------------------
    // 入力フォーム＞各列に表示・非表示要素を設定
    //-----------------------------------------------------
    public static function setDataDisp($key): string
    {
        $array = appFuncCrmArray::invalidList();
        if (isset($array[$key])) {
            return appConfigStatus::clientCategoryInvalid;
        } else {
            return appConfigStatus::clientCategoryValid;
        }
    }
    //-----------------------------------------------------
    // 入力フォーム＞モーダル起動ボタンのテキスト
    //-----------------------------------------------------
    public static function modalBtnStr($inputValue, $selectItem, $selectItemString): string
    {
        $result = "---";
        if ($inputValue != '') {
            foreach ($selectItem as $itemKey => $item) {
                if ($inputValue === (string)$itemKey) {
                    if ($selectItemString != '') {
                        $result = $item[$selectItemString];
                    } else {
                        $result = $item;
                    }
                    $result = $item[$selectItemString];
                    break;
                }
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 入力フォーム＞対応ログ編集画面のinputTypeを変更
    //-----------------------------------------------------
    public static function formEditInputType($row): string
    {
        $result = "hidden";
        if (isset($row['input']) && isset($row['name'])) {
            $result = $row['input'];
            switch ($row['name']) {
                case self::db['delivery_status']['name']:
                case self::db['approval_status']['name']:
                    $result = 'checkbox';
                    break;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 入力フォーム＞対応ログ一覧のinputTypeを変更
    //-----------------------------------------------------
    public static function formSearchInputType($row): string
    {
        if (isset($row['input']) && isset($row['type'])) {
            $result = $row['input'];
            switch ($row['type']) {
                case "datetime":
                case "date":
                    $result = 'date-range';
                    break;
            }
        }
        return $result;
    }
    //-----------------------------------------------------
    // 入力フォーム＞チェックボックス
    //-----------------------------------------------------
    public static function checkbox($inputName, $inputValue, $checkValue, $noCheckValue): string
    {
        $add = "";
        if ($inputValue === $checkValue) {
            $add = "checked";
        }
        $result = <<<EOF
        data-input-check='{"target":"input[name={$inputName}]","checkValue":"{$checkValue}","noCheckValue":"{$noCheckValue}"}' {$add}
        EOF;
        return $result;
    }
    //-----------------------------------------------------
    // 入力フォーム＞セレクトメニュー
    //-----------------------------------------------------
    public static function selectMenu($inputValue, $selectItem, $selectItemString): string
    {
        $result = "";
        foreach ($selectItem as $itemKey => $item) {
            $selected = "";
            $title = $item;
            if ($inputValue === (string)$itemKey) {
                $selected = 'selected';
            }
            if ($selectItemString != '') {
                $title = $item[$selectItemString];
            }
            $result .= <<<EOF
            <option value="{$itemKey}" {$selected}>{$title}</option>
            EOF;
        }
        return $result;
    }
    //-----------------------------------------------------
    // 入力フォーム＞アコーディオン
    //-----------------------------------------------------
    public static function accordion(array $dbResult, string $key, string $param): string
    {
        if ($dbResult[$key] === '' || $dbResult[$key] === $param) {
            return 'true';
        } else {
            return 'false';
        }
    }
    //-----------------------------------------------------
    // テキスト作成：検索結果
    //-----------------------------------------------------
    public static function searchString(array $table, array $get = []): string
    {
        $result = "";
        foreach ($get as $key => $value) {
            /*getパラメータ走査*/
            if (isset($table[$key]) && $value != '') {
                /*分岐1：DBに値が存在するパラメータ*/
                if ($table[$key]['input'] === 'hidden') {
                    /*分岐1-1：非表示フォーム*/
                    continue;
                } elseif ($table[$key]['input'] === 'select') {
                    /*分岐1-2：セレクトメニュー*/
                    $value = appFuncDataformat::selectmenu($table, $key, $value);
                } elseif ($table[$key]['input'] === 'date' || $table[$key]['input'] === 'datetime-local') {
                    /*分岐1-3：日時（範囲指定）*/
                    $date = appFuncSql::whereBetweenGetParam($get, $key);
                    if ($date['min'] != '') {
                        $value = $date['min'];
                        if ($date['max'] != '') {
                            $value .= '~' . $date['max'];
                        }
                    } else {
                        continue;
                    }
                }
                $result .= $table[$key]['comment'];
                $result .= '「' . $value . '」、';
            }
        }
        if ($result != '') {
            /*判断：文字が存在*/
            $result = mb_substr($result, 0, -1);
        }
        return $result;
    }
}
