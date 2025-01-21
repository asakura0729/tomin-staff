</article>

<?php if (appConfigPage::$tmpl != 'simple') : ?>
    <aside id="bottom" class="l-bottom is-firstview p-5 print-none" data-disp="firstview">
        <div class="text-right">
            <a href="#page-top" class="pl-3 pr-3 pb-2 text-center bg-black-08 rounded font-size-2">
                <i class="fa fa-angle-up color-white" aria-hidden="true"></i>
            </a>
        </div>
    </aside>
<?php endif; ?>

<script src="/assets/js/jquery-3.4.1.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/common.js?20220318"></script>
<?php echo appConfigPage::$js; ?>
<script src="/assets/js/imagesLoaded.js"></script>
<script src="/assets/js/echo.js"></script>