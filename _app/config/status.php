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
        'progress' => ['key' => 'progress', 'name' => '未承認'],
        'complete' => ['key' => 'complete', 'name' => '承認済'],
    ];

    /*発送状況*/
    public const delivery_status = [
        'unnecessary' => ['key' => 'unnecessary', 'name' => '発送不要'],
        'required' => ['key' => 'required', 'name' => '発送済'],
    ];

    /*架電ステータス*/
    public const cs_tel_status = [
        'unnecessary' => ['key' => 'unnecessary', 'name' => '架電不要'],
        'required' => ['key' => 'required', 'name' => '要架電'],
        'complete' => ['key' => 'complete', 'name' => '架電完了']
    ];

    /*顧客カテゴリ*/
    public const clientCategoryValid = 'valid'; //有効顧客
    public const clientCategoryInvalid = 'invalid'; //無効顧客
    public const clientCategory = [
        'contact' => ['key' => 'contact', 'name' => '問い合わせ(初回)', 'type' => self::clientCategoryValid],
        'contact_re' => ['key' => 'contact_re', 'name' => '問い合わせ(再)', 'type' => self::clientCategoryValid],
        'order' => ['key' => 'order', 'name' => '(既死)ご依頼(初回)', 'type' => self::clientCategoryValid],
        'order_re' => ['key' => 'order_re', 'name' => '(既死)ご依頼(再)', 'type' => self::clientCategoryValid],
        'order_re_alive' => ['key' => 'order_re_alive', 'name' => '(存命当月)ご依頼(再)', 'type' => self::clientCategoryValid],
        'order_re_alive_mo' => ['key' => 'order_re_alive_mo', 'name' => '(存命)ご依頼(再)', 'type' => self::clientCategoryValid],
        'contact_after' => ['key' => 'contact_after', 'name' => '依頼後の問い合わせ', 'type' => self::clientCategoryValid],
        'reservation' => ['key' => 'reservation', 'name' => '事前予約(初回)', 'type' => self::clientCategoryValid],
        'reservation_re' => ['key' => 'reservation_re', 'name' => '事前予約(再)', 'type' => self::clientCategoryValid],
        'consultation' => ['key' => 'consultation', 'name' => '対面相談(初回)', 'type' => self::clientCategoryValid],
        'consultation_re' => ['key' => 'consultation_re', 'name' => '対面相談(再)', 'type' => self::clientCategoryValid],
        'document_request' => ['key' => 'document_request', 'name' => '資料請求(web)', 'type' => self::clientCategoryValid],
        'cancel' => ['key' => 'cancel', 'name' => 'キャンセル', 'type' => self::clientCategoryValid],
        'other_valid' => ['key' => 'other_invalid', 'name' => 'その他（有効電話）', 'type' => self::clientCategoryValid],
        'wrong' => ['key' => 'wrong', 'name' => '間違い電話', 'type' => self::clientCategoryInvalid],
        'prank' => ['key' => 'prank', 'name' => 'いたずら電話', 'type' => self::clientCategoryInvalid],
        'silent' => ['key' => 'silent', 'name' => '無言電話', 'type' => self::clientCategoryInvalid],
        'interruption' => ['key' => 'interruption', 'name' => '放棄', 'type' => self::clientCategoryInvalid],
        'sales' => ['key' => 'sales', 'name' => '営業電話', 'type' => self::clientCategoryInvalid],
        'competitors' => ['key' => 'competitors', 'name' => '同業他社', 'type' => self::clientCategoryInvalid],
        'other_invalid' => ['key' => 'other_invalid', 'name' => 'その他（無効電話）', 'type' => self::clientCategoryInvalid],
    ];

    /*報告状況*/
    public const funeral_status = [
        'progress' => ['key' => 'progress', 'name' => '未完了'],
        'complete' => ['key' => 'complete', 'name' => '完了'],
    ];
}
