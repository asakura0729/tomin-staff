<?php
//======================================================================
// CRM＞表示や見た目の制御
//======================================================================
class appFuncCrmDisp
{
    public const db = appDatabaseCs::table;
    //-----------------------------------------------------
    // 対応ログストレージ保存（開始）
    //-----------------------------------------------------
    public static function storageStart()
    {
        if (count($_GET) <= 0) {
            /*分岐:新規作成*/
            appFuncStorage::start();
        }
    }
    //-----------------------------------------------------
    // 対応ログストレージ保存（終了）
    //-----------------------------------------------------
    public static function storageEnd()
    {
        if (count($_GET) <= 0) {
            /*分岐:新規作成*/
            appFuncStorage::end();
        }
    }
    //-----------------------------------------------------
    // 対応ログ編集画面タイトル
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
    // 入力フォーム見出しの名称変更
    //-----------------------------------------------------
    public static function renameTitle($key, $title): string
    {
        if (isset(appDatabaseCs::rename[$key])) {
            return appDatabaseCs::rename[$key];
        } else {
            return $title;
        }
    }
    //-----------------------------------------------------
    // 入力フォーム見出しの名称変更(複数)
    //-----------------------------------------------------
    public static function renameTitles($array): array
    {
        $result = [];
        foreach ($array as $key => $row) {
            $row['comment'] = self::renameTitle($key, $row['comment']);
            $result[$key] = $row;
        }
        return $result;
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
    // 入力フォーム＞横幅調整
    //-----------------------------------------------------
    public static function setListRowWidth($inputName, $inputType): string
    {
        $result = "";
        switch ($inputName) {
            case self::db['ensconce_address']['name']:
                $result = '250';
                break;
            case self::db['comment']['name']:
                $result = '400';
                break;
            case self::db['total_price']['name']:
            case self::db['hall_price']['name']:
                $result = '150';
                break;
            case self::db['post_by']['name']:
            case self::db['delivery_status']['name']:
            case self::db['approval_status']['name']:
            case self::db['funeral_status']['name']:
            case self::db['client_region']['name']:
            case self::db['dec_region']['name']:
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
                        $result = '100';
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
        $btnTitle = "承認";
        $csId = $value[appDatabaseCs::primaryKey];
        $approvalStatusKey = self::db['approval_status']['name'];
        $approvalStatus = $value['dbresult'][$approvalStatusKey];
        $insertApprovalStatus = "";
        switch ($approvalStatus) {
            case appConfigStatus::approval_status['started']['key']:
                /*分岐1：未申請*/
                $result['disabled'] = true;
                $result['popover'] = '未申請のため、承認できません';
                break;
            case appConfigStatus::approval_status['progress']['key']:
                /*分岐2：未承認*/
                $insertApprovalStatus = appConfigStatus::approval_status['complete']['key'];
                $result['add'] = <<<EOF
                data-edit-approval='{"cs_id":"{$csId}","approval_status":"{$insertApprovalStatus}"}'
                EOF;
                break;
            case appConfigStatus::approval_status['complete']['key']:
                /*分岐3：承認済*/
                $btnTitle = "承認済";
                $result['disabled'] = true;
                $result['popover'] = '承認済です';
                break;
        }
        $result['title'] = $btnTitle;
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
    // 入力フォーム＞特定のカテゴリのinputTypeを変更
    //-----------------------------------------------------
    public static function changeInputType($row): string
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
                }
                if ($table[$key]['input'] === 'select') {
                    /*分岐1-2：セレクトメニュー*/
                    $value = appFuncDataformat::selectmenu($table, $key, $value);
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
