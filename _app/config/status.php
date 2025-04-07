<?php
//======================================================================
// ステータス・パラメータ関係
//======================================================================
class appConfigStatus
{
    /*対応ログ_カテゴリ*/
    public const csCategoryLog = 'log'; //対応ログ
    public const csCategorySheet = 'sheet'; //送客シート

    /*承認ステータス*/
    public const approval_status = [
        'progress' => '未完了',
        'complete' => '完了'
    ];
    /*作業ステータス*/
    public const edit_status = [
        'progress' => '作業中',
        'complete' => '作業完了'
    ];
    /*発送状況*/
    public const delivery_status = [
        'unnecessary' => '発送不要',
        'required' => '要発送'
    ];
    /*架電ステータス*/
    public const cs_tel_status = [
        'unnecessary' => '架電不要',
        'required' => '要架電',
        'complete' => '架電完了'
    ];
    /*顧客カテゴリ*/
    public const clientCategoryValid = 'valid'; //有効顧客
    public const clientCategoryInvalid = 'invalid'; //無効顧客
    public const clientCategory = [
        'contact' => ['name' => '問い合わせ(初回)', 'type' => self::clientCategoryValid],
        'contact_re' => ['name' => '問い合わせ(再)', 'type' => self::clientCategoryValid],
        'order' => ['name' => 'ご依頼(初回)', 'type' => self::clientCategoryValid],
        'order_re' => ['name' => 'ご依頼(再)', 'type' => self::clientCategoryValid],
        'reservation' => ['name' => '事前予約(初回)', 'type' => self::clientCategoryValid],
        'reservation_re' => ['name' => '事前予約(再)', 'type' => self::clientCategoryValid],
        'consultation' => ['name' => '対面相談(初回)', 'type' => self::clientCategoryValid],
        'consultation_re' => ['name' => '対面相談(再)', 'type' => self::clientCategoryValid],
        'document_request' => ['name' => '資料請求(web)', 'type' => self::clientCategoryValid],
        'cancel' => ['name' => 'キャンセル', 'type' => self::clientCategoryValid],
        'other_enabled' => ['name' => 'その他（有効電話）', 'type' => self::clientCategoryValid],
        'wrong' => ['name' => '間違い電話', 'type' => self::clientCategoryInvalid],
        'prank' => ['name' => 'いたずら電話', 'type' => self::clientCategoryInvalid],
        'silent' => ['name' => '無言電話', 'type' => self::clientCategoryInvalid],
        'interruption' => ['name' => '放棄', 'type' => self::clientCategoryInvalid],
        'sales' => ['name' => '営業電話', 'type' => self::clientCategoryInvalid],
        'competitors' => ['name' => '同業他社', 'type' => self::clientCategoryInvalid],
        'unknown' => ['name' => '不明', 'type' => self::clientCategoryInvalid],
        'other_invalid' => ['name' => 'その他（無効電話）', 'type' => self::clientCategoryInvalid],
    ];
    /*報告状況*/
    public const funeral_status = [
        'progress' => '未完了',
        'complete' => '完了'
    ];
    /*印刷状況*/
    public const printStatusProgress = 'progress';
    public const printStatusComplete = 'complete';
    public const print_status = [
        self::printStatusProgress => '未完了',
        self::printStatusComplete => '完了'
    ];
}
