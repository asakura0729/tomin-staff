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
        '1' => ['userid' => '1', 'loginid' => 'tpf', 'password' => 'tp0135', 'username' => 'スタッフ', 'authority' => self::staff],
        '2' => ['userid' => '2', 'loginid' => 'master', 'password' => 'master', 'username' => '管理者', 'authority' => self::manager],
    ];

    public const selectmenu = [
        self::list['asumi']['username'],
        self::list['mizuki']['username'],
        self::list['okubo']['username']
    ];
}
