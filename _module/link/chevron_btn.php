<?php
//======================================================================
// 通常リンク(頭に丸い矢印)
//======================================================================
?>
<a class="btn bg-white rounded-pill opacity-hover-075 border-contrast pt-1 pb-2 pl-3 pr-4 <?php appFuncDisp::boolString($disabled, "opacity-025", "") ?> <?php echo $addClass; ?>" <?php if ($disabled === false): ?><?php echo appFuncDisp::hxLink($sitemapData, $queryParam, $hxLinkOption); ?><?php else: ?><?php echo $popover; ?><?php endif; ?> <?php echo $addParam; ?>>
    <span class="color-contrast"><i class="fa fa-chevron-circle-right pr-2" aria-hidden="true"></i><?php echo $title; ?></span>
</a>