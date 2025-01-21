<label for="<?php echo $name; ?>" class="cursor-pointer bg-lgray d-block position-relative w-100 h-200px">
    <div data-thumbnail="<?php echo $name; ?>" class="position-middle-center z-index-200">
        <?php if ($value != 'noimage') : ?>
            <img src="<?php echo $value; ?>?<?php echo appConfigPage::$date; ?>" alt="IMAGE" class="thum-img">
        <?php endif; ?>
    </div>
    <div class="position-middle-center z-index-100">
        <span class="d-block font-size-3"><i class="fa fa-picture-o color-gray" aria-hidden="true"></i></span>
        <span class="d-block color-gray"><?php echo $title; ?></span>
    </div>
    <input id="<?php echo $name; ?>" type="file" name="<?php echo $name; ?>" class="d-none" value="<?php echo $value; ?>">
</label>