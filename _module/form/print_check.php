<div class="pb-3">
    <?php if ($title != null) : ?>
        <div class="pb-1"><?php echo $addTitle; ?><?php echo $title; ?></div>
    <?php endif; ?>
    <div class="border border-dark p-2">
        <?php foreach ($answer as $key => $answerValue) : ?>
            <?php if ($key === 0) : ?>
                <span class="d-inline-block"><?php echo $answerValue; ?></span>
            <?php else : ?>
                <span class="d-inline-block">&nbsp;／&nbsp;<?php echo $answerValue; ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>