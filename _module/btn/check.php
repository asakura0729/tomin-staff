<?php
//======================================================================
// チェックボタン
//======================================================================
?>
<button type="button" class="btn bg-contrast opacity-hover-075 p-1 w-100 font-size-0_9 rounded-pill <?php echo appFuncString::boolString($disabled, 'opacity-025', ''); ?> <?php echo $addClass; ?>" <?php if($disabled===true):?><?php echo $popover;?> <?php echo $disabled; ?><?php endif;?> <?php echo $addParam; ?>>
    <span class="color-white"><i class="fa fa-check pr-1" aria-hidden="true"></i><?php echo appFuncString::strlenString($title, '登 録'); ?></span>
</button>