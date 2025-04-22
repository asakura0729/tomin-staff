<?php
//======================================================================
// 入力フォーム（通常）
//======================================================================
?>
<?php if ($editFlg === false) : ?>
    <?php echo $inputValue; ?>
<?php elseif ($inputType === 'textarea'): ?>
    <textarea name="<?php echo $inputName; ?>" class="h-100 form-control" <?php echo $addParam; ?>><?php echo $inputValue; ?></textarea>
<?php elseif ($inputType === 'select'): ?>
    <select name="<?php echo $inputName; ?>" class="form-control">
        <?php if ($selectItemNoValue === true): ?>
            <option value="">指定なし</option>
        <?php endif; ?>
        <?php echo appFuncCrmDisp::selectMenu($inputValue, $selectItem, $selectItemString); ?>
    </select>
<?php else: ?>
    <input name="<?php echo $inputName; ?>" type="<?php echo $inputType; ?>" class="form-control" value="<?php echo $inputValue; ?>" <?php echo $addParam; ?>>
<?php endif; ?>