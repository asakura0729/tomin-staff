<div id="<?php echo $id; ?>" class="row align-items-center no-gutters p-2 bg-white mb-2" data-sortable>
    <div class="col-7 pr-2">
        <div class="form-row align-items-center">
            <div class="col-1 text-center srt_hndl" style="cursor:pointer"><i class="fa fa-sort" aria-hidden="true"></i></div>
            <div class="col-11"><input type="text" autocomplete="off" name="item[]" class="form-control" placeholder="商品名を記入してください" value="<?php echo $itemName; ?>"></div>
        </div>
    </div>
    <div class="col-1">
        <input type="text" autocomplete="off" pattern="\d*" name="item[]" class="form-control text-right" placeholder="0" value="<?php echo $itemInt; ?>" data-int data-parent="#item[]_<?php echo $number; ?>">
    </div>
    <div class="col-2 pl-2">
        <input type="text" autocomplete="off" pattern="\d*" name="item[]" class="form-control text-right" placeholder="0" value="<?php echo $itemPrice; ?>" data-price>
    </div>
    <div class="col-2 text-right">
        <span class="mr-2" data-group="item[]" data-parent="#<?php echo $id; ?>" data-disp="price">0</span>円
        <button type="button" class="btn" data-del="#<?php echo $id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
</div>