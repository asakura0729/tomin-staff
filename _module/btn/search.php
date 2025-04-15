<?php
//======================================================================
// 検索ボタン
//======================================================================
?>
<button data-submit-search type="submit" class="btn bg-white font-size-1_4 pt-1 pb-2 pl-2 pr-2 w-100 rounded-pill border-contrast opacity-hover-075 <?php echo appFuncString::boolString($disabled, 'opacity-025', ''); ?> <?php echo $addClass; ?>" <?php echo $addParam; ?>>
    <span class="color-contrast"><i class="fa fa-search pr-2" aria-hidden="true"></i><?php echo appFuncString::strlenString($title, $title, '検 索'); ?></span>
</button>