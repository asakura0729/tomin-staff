<?php
//======================================================================
// セレクトメニュー
//======================================================================
?>
<div class="pb-2">
    <?php appFuncDisp::globalModule('form/label', ['title' => $title]); ?>
    <select class="form-control" name="<?php echo $inputName; ?>" <?php echo $add; ?>>
        <?php foreach ($selectItem as $key => $selectItemValue) : ?>
            <?php if ($value == $key) : ?>
                <option value="<?php echo $key; ?>" selected>
                    <?php echo $selectItemValue; ?>
                </option>
            <?php else : ?>
                <option value="<?php echo $key; ?>">
                    <?php echo $selectItemValue; ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</div>