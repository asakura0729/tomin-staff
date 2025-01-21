<div class="pb-3">
    <?php if ($title != null) : ?>
        <div class="pb-3"><?php echo $addTitle; ?><?php echo $title; ?></div>
    <?php endif; ?>
    <div class="border p-2">
        <div class="form-check font-size-1_2">
            <input type="radio" name="<?php echo $id; ?>" class="d-none" required>
            <?php foreach ($answer as $key => $answerValue) : ?>
                <input id="<?php echo $id; ?>_<?php echo $key; ?>" type="radio" name="<?php echo $id; ?>" class="d-none" value="<?php echo $answerValue; ?>">
                <label for="<?php echo $id; ?>_<?php echo $key; ?>" class="btn-formlabel d-inline-block p-3 pr-3 m-0 mr-2 cursor-pointer">
                    <?php echo $answerValue; ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>