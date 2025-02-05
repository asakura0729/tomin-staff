<?php
//======================================================================
// ラジオボタン(メニューバー用)
//======================================================================
?>
<div class="pr-4"><?php echo $title; ?></div>
<?php foreach ($selectItem as $key => $selectItemValue) : ?>
    <div class="pr-3">
        <label class="d-inline-block cursor-pointer m-0 pt-2 pb-2">
            <input type="radio" value="<?php echo $key; ?>" name="<?php echo $inputName; ?>" <?php echo $add; ?><?php if ($value == $key) : ?> checked<?php endif; ?>>
            <?php echo $selectItemValue; ?>
        </label>
    </div>
<?php endforeach; ?>