<?php
//======================================================================
// ユーザー情報
//======================================================================
class appConfigUser
{
    public const level = [
        'master' => ['id' => 'master', 'name' => '最上位権限', 'level' => 3],
        'manager' => ['id' => 'manager', 'name' => 'マネージャー', 'level' => 2],
        'staff' => ['id' => 'staff', 'name' => 'スタッフ', 'level' => 1],
        'guest' => ['id' => 'guest', 'name' => 'ゲスト', 'level' => 0]
    ];

    /*public const list = [
        'staff' => ['id' => 'staff', 'password' => 'tp8396', 'username' => 'スタッフ', 'level' => self::level['manager']['level']],
    ];*/
    public const list = [
        'tpf' => ['userid' => '1', 'loginid' => 'tpf', 'password' => 'tp0135', 'username' => 'スタッフ', 'level' => self::level['staff']['level']],
        'master' => ['userid' => '0', 'loginid' => 'master', 'password' => 'master', 'username' => 'スタッフ', 'level' => self::level['manager']['level']],
    ];

    public const selectmenu = [
        self::list['asumi']['username'],
        self::list['mizuki']['username'],
        self::list['okubo']['username']
    ];
}
