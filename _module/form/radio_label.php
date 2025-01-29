<?php
//======================================================================
// ラジオボタン
//======================================================================
?>
<div class="pb-2">
    <?php appLibraryDisp::globalModule('form/label', ['title' => $title]); ?>
    <?php foreach ($selectItem as $key => $selectItemValue) : ?>
        <?php if ($value == $key) : ?>
            <input type="radio" value="<?php echo $key; ?>" name="<?php echo $inputName; ?>" <?php echo $add; ?> checked>
            <?php echo $selectItemValue; ?>
        <?php else : ?>
            <input type="radio" value="<?php echo $key; ?>">
            <?php echo $selectItemValue; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>