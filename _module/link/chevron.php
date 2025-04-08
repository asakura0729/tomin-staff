<?php
//======================================================================
// 通常リンク(頭に丸い矢印)
//======================================================================
?>
<a class="btn text-left opacity-hover-075 <?php echo $addClass; ?>" <?php if ($disabled === false): ?><?php echo appFuncDisp::hxLink($sitemapData, $queryParam, $hxLinkOption); ?><?php else: ?><?php echo $popover; ?><?php endif; ?> <?php echo $addParam; ?>>
    <span class="<?php appFuncDisp::boolString($disabled, "color-lgray", "color-contrast") ?>"><i class="fa fa-chevron-circle-right pr-2" aria-hidden="true"></i><?php echo $title; ?></span>
</a>