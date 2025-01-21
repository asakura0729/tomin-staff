<div id="<?php echo $name; ?>_<?php echo $number; ?>" class="row align-items-center no-gutters pb-2">
    <div class="col-1 text-center">
        <button type="button" class="btn" data-del="#<?php echo $name; ?>_<?php echo $number; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
    <div class="col-4 pr-2">
        <input type="text" autocomplete="off" name="<?php echo $name; ?>[]" class="form-control" placeholder="例）システム設計費" value="<?php echo $itemName; ?>">
    </div>
    <div class="col-1">
        <input type="text" autocomplete="off" pattern="\d*" name="<?php echo $name; ?>[]" class="form-control text-right" placeholder="0" value="<?php echo $itemInt; ?>" data-int data-parent="#<?php echo $name; ?>_<?php echo $number; ?>">
    </div>
    <div class="col-3 pl-2">
        <input type="text" autocomplete="off" pattern="\d*" name="<?php echo $name; ?>[]" class="form-control text-right" placeholder="0" value="<?php echo $itemPrice; ?>" data-price>
    </div>
    <div class="col-3 text-right">
        <span class="mr-2" data-group="<?php echo $name; ?>" data-parent="#<?php echo $name; ?>_<?php echo $number; ?>" data-disp="price">0</span>円
    </div>
</div>