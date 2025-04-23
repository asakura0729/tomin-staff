<?php
require_once '../_app/ssl_base.php'; ?>
<?php appConfigPage::$title = "TEST"; ?>
<?php require_once '../_tmpl/header.php'; ?>


<div id="test" style="height:3000px;">
    <script>
        setTimeout(function() {
            window.scrollTo(0, 0);
        }, 3000);
    </script>
</div>

<?php require_once '../_tmpl/l-footer.php'; ?>
<?php require_once '../_tmpl/footer.php'; ?>