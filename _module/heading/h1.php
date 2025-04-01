<?php
//======================================================================
// 大見出し
//======================================================================
?>
<header class="container">
    <<?php echo $tag; ?> class="font-size-2 text-center pb-4 color-contrast <?php echo $addClass; ?>">
        <?php if ($icon != ''): ?><i class="pr-2 fa <?php echo $icon; ?>" aria-hidden="true"></i><?php endif; ?><?php echo $title; ?>
    </<?php echo $tag; ?>>
</header>