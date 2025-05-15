<?php
//======================================================================
// 部品：件数表示（申請中の対応ログ）
//======================================================================
?>
<?php /*暫定対応...ssl_baseだとログインページに遷移するため*/ ?>
<?php require_once '../../_app/base.php'; ?>
<span class="badge badge-pill badge-danger p-empty-0"><?php appFuncStorage::load(appConfigPage::$path); ?></span>