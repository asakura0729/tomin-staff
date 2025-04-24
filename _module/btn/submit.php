<?php
//======================================================================
// SUBMITボタン
//======================================================================
?>
<button type="button" class="btn bg-contrast opacity-hover-075 font-size-1_4 pt-1 pb-2 pl-2 pr-2 w-100 rounded-pill <?php echo appFuncString::boolString($disabled, 'opacity-025', ''); ?> <?php echo $addClass; ?>" <?php if ($disabled === true): ?><?php echo $popover; ?> <?php echo $disabled; ?><?php else: ?>data-submit<?php endif; ?> <?php echo $addParam; ?>>
    <span class="color-white"><i class="fa fa-pencil pr-2" aria-hidden="true"></i><?php echo appFuncString::strlenString($title, '登 録'); ?></span>
</button>