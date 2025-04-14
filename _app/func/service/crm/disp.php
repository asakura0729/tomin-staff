<?php
//======================================================================
// CRM＞表示や見た目の制御
//======================================================================
class appFuncCrmDisp
{
    //-----------------------------------------------------
    // 見出しの名称変更
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
    // 見出しの名称変更(複数)
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
    // 対応ログ一覧＞背景色
    //-----------------------------------------------------
    public static function setBgcolor($value): string
    {
        $result = "bg-white";
        $funeralStatus = $value['dbresult'][appDatabaseCs::table['funeral_status']['name']];
        $clientCategory = $value['dbresult'][appDatabaseCs::table['client_category']['name']];
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
            case appDatabaseCs::table['ensconce_address']['name']:
                $result = '250';
                break;
            case appDatabaseCs::table['comment']['name']:
                $result = '400';
                break;
            case appDatabaseCs::table['total_price']['name']:
            case appDatabaseCs::table['hall_price']['name']:
                $result = '150';
                break;
            case appDatabaseCs::table['post_by']['name']:
            case appDatabaseCs::table['delivery_status']['name']:
            case appDatabaseCs::table['approval_status']['name']:
            case appDatabaseCs::table['funeral_status']['name']:
            case appDatabaseCs::table['client_region']['name']:
            case appDatabaseCs::table['dec_region']['name']:
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
        $approvalStatusKey = appDatabaseCs::table['approval_status']['name'];
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
                break;
            case appConfigStatus::approval_status['complete']['key']:
                /*分岐3：承認済*/
                $btnTitle = "承認取消";
                $insertApprovalStatus = appConfigStatus::approval_status['progress']['key'];
                break;
        }
        $result['title'] = $btnTitle;
        if ($approvalStatus != appConfigStatus::approval_status['started']['key']) {
            $result['add'] = <<<EOF
            data-edit-approval='{"cs_id":"{$csId}","approval_status":"{$insertApprovalStatus}"}'
            EOF;
        } else {
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
            case appDatabaseCs::table['comment']['name']:
                $colClass = 'w-600px';
                break;
            case appDatabaseCs::table['client_category']['name']:
                $colClass = 'w-200px';
                break;
            case appDatabaseCs::table['delivery_status']['name']:
            case appDatabaseCs::table['approval_status']['name']:
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
        if (isset(appDatabaseCs::tableInvalid[$key])) {
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
            <option value="{$itemKey}" {$selected}>{$title}</option>;
            EOF;
        }
        return $result;
    }
}
