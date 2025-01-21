<select class="form-control" name="<?php echo $name; ?>" <?php echo $add; ?>>
    <?php foreach ($choices as $key => $choicesValue) : ?>
        <?php if ($value == $choicesValue) : ?>
            <option value="<?php echo $choicesValue; ?>" selected>
                <?php echo $choicesValue; ?>
            </option>
        <?php else : ?>
            <option value="<?php echo $choicesValue; ?>">
                <?php echo $choicesValue; ?>
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>