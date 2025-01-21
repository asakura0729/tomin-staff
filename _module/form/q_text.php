<div class="pb-3">
    <?php if ($title != null) : ?>
        <div class="pb-3"><?php echo $addTitle;?><?php echo $title; ?></div>
    <?php endif; ?>
    <div>
        <input id="editor" type="text" name="<?php echo $id; ?>" class="form-control" placeholder="テキストを記入してください" value="" <?php echo $addForm; ?> size="200">
    </div>
</div>