<form method="get">
    <div class="input-group">
        <input type="text" name="<?php echo $inputName; ?>" autocomplete="off" class="form-control form-inputtextright" placeholder="<?php echo $placeholder; ?>" value="<?php echo $value; ?>">
        <div class="input-group-append">
            <button class="btn bg-contrast pl-4 pr-4" type="submit" <?php echo $add; ?>>
                <i class="fa fa-search color-white" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</form>