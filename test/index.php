<?php
require_once '../_app/ssl_base.php'; ?>
<?php appConfigPage::$title = "TEST"; ?>
<?php require_once '../_tmpl/header.php'; ?>


<div id="test">
    <table class="table table-bordered">
        <?php foreach (appConfigFuneral::plan as $key => $value): ?>
            <tr>
                <th><?php echo $key; ?></th>
                <td><?php echo $value['name']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<?php require_once '../_tmpl/l-footer.php'; ?>
<?php require_once '../_tmpl/footer.php'; ?>