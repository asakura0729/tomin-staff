<?php
//======================================================================
// グローバルナビゲーションのリンク
//======================================================================
?>
<a class="btn" data-htmx-get="<?php echo appRoutesWeb::sitemap[$option['page']]['contents']; ?>" data-htmx-url="<?php echo appRoutesWeb::sitemap[$option['page']]['path']; ?>">
    <span class="color-dgray"><?php echo appRoutesWeb::sitemap[$option['page']]['title']; ?></span>
</a>