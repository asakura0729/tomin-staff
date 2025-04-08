<?php
//======================================================================
// 印刷ボタン
//======================================================================
?>
<button type="button" class="btn bg-contrast opacity-hover-075 font-size-1_4 pt-1 pb-2 pl-2 pr-2 w-100 rounded-pill <?php echo $addClass;?>" onclick="window.print();" <?php echo $addParam; ?>>
    <span class="color-white"><i class="fa fa-print pr-2" aria-hidden="true"></i><?php echo appFuncString::strlenString($title, $title, '印 刷'); ?></span>
</button>