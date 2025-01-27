<?php if ($option['id'] != ''): ?>
    <input type="hidden" name="<?php echo appConfigStatus::postType; ?>" value="<?php echo appConfigStatus::postTypeUpdate; ?>">
<?php else: ?>
    <input type="hidden" name="<?php echo appConfigStatus::postType; ?>" value="<?php echo appConfigStatus::postTypeInsert; ?>">
<?php endif; ?>