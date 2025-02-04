<?php
//======================================================================
// collapseボタン
//　$option['title']...見出し
//　$option['target']...開閉させたい要素
//　$option['icon']...アイコン（https://fontawesome.com/v4/icon/list）
//======================================================================
?>
<?php if (!isset($option['title'])): ?>
    <button type="button" class="btn btn-collapse-icon bg-contrast-l w-100 collapsed" data-toggle="collapse" href="<?php echo $option['target']; ?>" role="button" aria-expanded="false" <?php if (isset($option['add'])): ?><?php echo $option['add']; ?><?php endif; ?>>
        <span class="color-contrast">&nbsp;</span>
    </button>
<?php else: ?>
    <button type="button" class="btn btn-collapse-text bg-contrast-l w-100 collapsed" data-toggle="collapse" href="<?php echo $option['target']; ?>" role="button" aria-expanded="false" <?php if (isset($option['add'])): ?><?php echo $option['add']; ?><?php endif; ?>>
        <span class="color-contrast"><?php if (isset($option['icon'])): ?><i class="pr-2 fa <?php echo $option['icon']; ?>" aria-hidden="true"></i><?php endif; ?><?php echo $option['title']; ?></span>
    </button>
<?php endif; ?>