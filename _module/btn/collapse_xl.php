<?php
//======================================================================
// collapseボタン
//　$option['title']...見出し
//　$option['target']...開閉させたい要素
//======================================================================
?>
<?php if (!isset($option['title'])): ?>
    <button type="button" class="btn btn-collapse-icon bg-contrast-l w-100 collapsed" data-toggle="collapse" href="<?php echo $option['target']; ?>" role="button" aria-expanded="false">
        <span class="color-contrast">&nbsp;</span>
    </button>
<?php else: ?>
    <button type="button" class="btn btn-collapse-text bg-contrast-l w-100 collapsed" data-toggle="collapse" href="<?php echo $option['target']; ?>" role="button" aria-expanded="false">
        <span class="color-contrast"><?php echo $option['title']; ?></span>
    </button>
<?php endif; ?>