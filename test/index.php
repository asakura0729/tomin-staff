<?php
require_once '../_app/ssl_base.php'; ?>
<?php appConfigPage::$title = "TEST"; ?>
<?php require_once '../_tmpl/header.php'; ?>

<?php echo appLibraryCrm::getCsReportSql('10'); ?>

<div class="pt-5">
    <form method="POST">
        <?php foreach (appDatabaseReport::table as $value): ?>
            <?php echo $value[appConfigDatabase::row]; ?>
            <input type="test" name="<?php echo $value[appConfigDatabase::row]; ?>" value="<?php echo appDatabaseReport::categoryCs; ?>">
            <br>
        <?php endforeach; ?>
        <?php foreach (appDatabaseReport::tableCs as $value): ?>
            <?php echo $value[appConfigDatabase::row]; ?>
            <input type="test" name="<?php echo $value[appConfigDatabase::row]; ?>" value="test">
            <br>
        <?php endforeach; ?>
        <button>SUBMIT</button>
    </form>
</div>

<?php require_once '../_tmpl/l-footer.php'; ?>
<?php require_once '../_tmpl/footer.php'; ?>