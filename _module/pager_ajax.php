<?php if (count($pageNumArray) > 0) : ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <?php if ($currentPageNum > 1) : ?>
                    <button class="page-link" type="button" data-ajax-data_empty_append="<?php echo $baseUri; ?>&page=<?php echo $pageNumPrev; ?>,<?php echo $appentTarget; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i></button>
                <?php else : ?>
                    <span class="page-link"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
                <?php endif; ?>
            </li>
            <?php foreach ($pageNumArray as $value) : ?>
                <?php if ($currentPageNum == $value) : ?>
                    <li class="page-item active"><span class="page-link"><?php echo $value; ?></span></li>
                <?php else : ?>
                    <li class="page-item">
                        <button class="page-link" type="button" data-ajax-data_empty_append="<?php echo $baseUri; ?>&page=<?php echo $value; ?>,<?php echo $appentTarget; ?>"><?php echo $value; ?></button>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <li class="page-item">
                <?php if ($pageNumNext <= $pagerCount) : ?>
                    <button class="page-link" type="button" data-ajax-data_empty_append="<?php echo $baseUri; ?>&page=<?php echo $pageNumNext; ?>,<?php echo $appentTarget; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
                <?php else : ?>
                    <span class="page-link"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
<?php endif; ?>
