<div class="h-100" data-photo-size>
    <?php if (appHttpClientPhoto::$photo[$photoId] != 'noimage') : ?>
        <img src="<?php echo appHttpClientPhoto::$photo[$photoId]; ?>?<?php echo appConfigPage::$date; ?>" alt="写真" class="w-100per mx-auto d-block">
    <?php else : ?>
        <div class="position-middle-center">NO-IMAGE</div>
    <?php endif; ?>
</div>