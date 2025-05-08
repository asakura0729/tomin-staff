<?php require_once '../../_app/ssl_base.php'; ?>
<?php require_once '../../_app/http/ajax/download/index.php'; ?>
<?php if (count(adminDownload::$dbResult) > adminDownload::$colCount): ?>
    ※データが<?php echo adminDownload::$colCount; ?>件を超えています。<?php echo adminDownload::$colCount; ?>件以降のデータは省略されます。
<?php endif; ?>
<?php echo appFuncCrmDisp::csv(adminDownload::$dbResult, adminDownload::$tableRow);
