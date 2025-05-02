<?php if (count($pageNumArray) > 0) : ?>
    <nav class="pt-4 pb-5">
        <ul class="pagination">
            <li class="page-item">
                <?php if ($currentPageNum > 1) : ?>
                    <a class="page-link" data-hx-get="<?php echo $hxGet; ?><?php echo $pageNumPrev; ?>" data-hx-target="<?php echo $hxTarget; ?>" <?php echo $add; ?>>
                        <i class="fa fa-caret-left" aria-hidden="true"></i>
                    </a>
                <?php else : ?>
                    <span class="page-link"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
                <?php endif; ?>
            </li>
            <?php foreach ($pageNumArray as $value) : ?>
                <?php if ($currentPageNum == $value) : ?>
                    <li class="page-item active"><span class="page-link"><?php echo $value; ?></span></li>
                <?php else : ?>
                    <li class="page-item">
                        <a class="page-link" data-hx-get="<?php echo $hxGet; ?><?php echo $value; ?>" data-hx-target="<?php echo $hxTarget; ?>" <?php echo $add; ?>>
                            <?php echo $value; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <li class="page-item">
                <?php if ($pageNumNext < $pagerCount) : ?>
                    <a class="page-link" data-hx-get="<?php echo $hxGet; ?><?php echo $pageNumNext; ?>" data-hx-target="<?php echo $hxTarget; ?>" <?php echo $add; ?>>
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                    </a>
                <?php else : ?>
                    <span class="page-link"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
<?php endif; ?>