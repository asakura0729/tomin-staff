<?php
//======================================================================
// 見出し
//======================================================================
?>
<header class="pb-2">
    <<?php echo $tag; ?> class="font-size-1_4 color-contrast <?php echo $addClass; ?>">
        <?php if ($icon != ''): ?><i class="pr-2 fa <?php echo $icon; ?>" aria-hidden="true"></i><?php endif; ?><?php echo $title; ?>
    </<?php echo $tag; ?>>
</header>