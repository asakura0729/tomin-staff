<?php if ($path == null) : ?>
    <li class="breadcrumb-item"><?php echo $title; ?></li>
<?php else : ?>
    <li class="breadcrumb-item"><a href="<?php echo $path; ?>"><?php echo $title; ?></a></li>
<?php endif; ?>