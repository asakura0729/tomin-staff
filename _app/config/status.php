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
        'required' => '要発送',
        'complete' => '発送済'
    ];
    /*架電ステータス*/
    public const cs_tel_status = [
        'unnecessary' => '架電不要',
        'required' => '要架電',
        'complete' => '架電完了'
    ];
    /*顧客ステータス（有効）*/
    public const clientCategoryEnabled = [
        'contact' => '問い合わせ(初回)',
        'contact_re' => '問い合わせ(再)',
        'order' => 'ご依頼(初回)',
        'order_re' => 'ご依頼(再)',
        'reservation' => '事前予約(初回)',
        'reservation_re' => '事前予約(再)',
        'consultation' => '対面相談(初回)',
        'consultation_re' => '対面相談(再)',
        'document_request' => '資料請求(web)',
        'cancel' => 'キャンセル',
        'other_enabled' => 'その他（有効電話）'
    ];
    /*顧客ステータス（無効）*/
    public const clientCategoryInvalid = [
        'wrong' => '間違い電話',
        'prank' => 'いたずら電話',
        'silent' => '無言電話',
        'interruption' => '放棄',
        'sales' => '営業電話',
        'competitors' => '同業他社',
        'unknown' => '不明',
        'other_invalid' => 'その他（無効電話）',
    ];
    /*報告状況*/
    public const funeral_status = [
        'progress' => '未完了',
        'complete' => '完了'
    ];
    /*印刷状況*/
    public const print_status = [
        'progress' => '未完了',
        'complete' => '完了'
    ];
}
