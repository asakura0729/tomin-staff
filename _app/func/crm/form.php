<?php
//======================================================================
// CRM＞フォーム関連
//======================================================================
class appFuncCrmForm
{
    //-----------------------------------------------------
    // 入力フォームの横幅調整
    //-----------------------------------------------------
    public static function setRowWidth($inputName, $inputType): string
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
            case 'textarea':
                $colClass = 'w-200px';
                break;
            default:
                $colClass = 'w-200px';
        }
        switch ($inputName) {
            case appDatabaseCs::table['comment']['name']:
                $colClass = 'w-400px';
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
    // 入力フォームの表示・非表示要素
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
    // 入力フォームの見出し変更
    //-----------------------------------------------------
    public static function title($inputName, $title): string
    {
        switch ($inputName) {
            case appDatabaseCs::table['funeral_date']['name']:
                $result = "葬儀希望日";
                break;
            case appDatabaseCs::table['hall_name']['name']:
                $result = "希望式場";
                break;
            case appDatabaseCs::table['crematory_name']['name']:
                $result = "希望火葬場";
                break;
            case appDatabaseCs::table['option_name']['name']:
                $result = "希望オプション";
                break;
            default:
                $result = $title;
                break;
        }
        return $result;
    }

    //-----------------------------------------------------
    // モーダル起動ボタン
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
    // チェックボックス
    //-----------------------------------------------------
    public static function checkbox($inputValue, $selectItem): string
    {
        $result = "";
        foreach ($selectItem as $itemKey => $item) {
            $checked = "";
            if ($inputValue === (string)$itemKey) {
                $checked = 'checked';
            }
        }
        $result .= <<<EOF
        value="{$itemKey}" {$checked}
        EOF;
        return $result;
    }

    //-----------------------------------------------------
    // セレクトメニュー
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
