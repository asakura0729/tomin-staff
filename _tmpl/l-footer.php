<?php if (appConfigPage::$tmpl != 'simple') : ?>
    <aside id="bottom" class="l-bottom is-firstview p-5 print-none text-right" data-disp="firstview">
        <a href="#page-top" class="btn-totop">
            <span class="font-size-3 line-height-0"><i class="fa fa-angle-up color-white" aria-hidden="true"></i></span>
        </a>
    </aside>
<?php endif; ?>

<script src="/assets/js/common.js?20220318"></script>
<?php echo appConfigPage::$js; ?>
<script src="/assets/js/echo.js"></script>