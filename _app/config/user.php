<?php
//======================================================================
// ユーザー情報
//======================================================================
class appConfigUser
{
    public const manager = 'manager';
    public const staff = 'staff';
    public const authority = [
        self::manager  => 3,
        self::staff => 2,
    ];

    public const list = [
        'tpf' => ['userid' => '1', 'loginid' => 'tpf', 'password' => 'tp0135', 'username' => 'スタッフ', 'authority' => self::staff],
        'master' => ['userid' => '0', 'loginid' => 'master', 'password' => 'master', 'username' => 'スタッフ', 'authority' => self::manager],
    ];

    public const selectmenu = [
        self::list['asumi']['username'],
        self::list['mizuki']['username'],
        self::list['okubo']['username']
    ];
}
