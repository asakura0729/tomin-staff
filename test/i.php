<?php require_once __DIR__ . '../../_app/base.php'; ?>
<?php appConfigPage::$title = "管理画面"; ?>
<?php require_once __DIR__ . '../../_tmpl/header.php'; ?>
<?php require_once __DIR__ . '../../_tmpl/l-header.php'; ?>

<main id="page-top" class="<?php if (appConfigPage::$tmpl != 'simple') : ?>l-wrap bg-lgray<?php endif; ?>">
  <?php echo appFuncSql::createSql('appDatabaseCs'); ?>
</main>

<?php require_once __DIR__ . '../../_tmpl/l-footer.php'; ?>
<?php require_once __DIR__ . '../../_tmpl/footer.php'; ?>