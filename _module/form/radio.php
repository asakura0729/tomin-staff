<div class="pb-3 <?php echo $add; ?>"><?php echo $title; ?></div>
<div class="border p-2">
    <div class="form-check">
        <?php foreach ($choices as $key => $choicesValue) : ?>
            <label for="<?php echo $name; ?>_<?php echo $key; ?>" class="d-block pr-4 mr-2">
                <input id="<?php echo $name; ?>_<?php echo $key; ?>" type="radio" name="<?php echo $name; ?>" class="form-check-input" value="<?php echo $choicesValue; ?>">
                <?php echo $choicesValue; ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>