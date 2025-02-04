<?php
//======================================================================
// 入力フォーム：テキスト：インライン
//======================================================================
?>
<?php if ($index === 0): ?>
    <div class="form-row pb-2">
    <?php endif; ?>
    <div class="col">
        <?php include __DIR__ . '/_module/input_text.php'; ?>
    </div>
    <?php if ($index === count($inputNames) - 1) : ?>
    </div>
<?php endif; ?>