<?php
//======================================================================
// ラジオボタン
//======================================================================
?>
<div class="row pb-2 <?php echo $css; ?>">
    <div class="col-3"><?php appFuncDisp::globalModule('form/label', ['title' => $title]); ?></div>
    <div class="col-9">
        <?php foreach ($selectItem as $key => $selectItemValue) : ?>
            <label class="d-inline-block cursor-pointer mr-2">
                <input type="radio" value="<?php echo $key; ?>" name="<?php echo $inputName; ?>" <?php echo $add; ?><?php if ($value == $key) : ?> checked<?php endif; ?>>
                <?php echo $selectItemValue; ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>