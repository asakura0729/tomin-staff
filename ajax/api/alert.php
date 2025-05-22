<?php
//======================================================================
// 部品：全体告知
//======================================================================
?>
<?php /*暫定対応...ssl_baseだとログインページに遷移するため*/ ?>
<?php require_once '../../_app/base.php'; ?>
<?php appFuncPage::noCache(); ?>
<?php if (appConfigSite::maintenance == true) : ?>
    <div class="alert alert-danger m-0 p-2 text-center rounded-0" role="alert">
        ただいまメンテナンス作業を行っています。データ登録・変更の操作は控えてください。
    </div>
<?php endif; ?>