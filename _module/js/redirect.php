<?php
//======================================================================
// javascript：リダイレクト
// $option['path']...リダイレクト先URL
//======================================================================
?>
<div class="cover-white">
    <?php appFuncModule::component('spinners'); ?>
</div>
<script>
    (function() {
        window.scrollTo(0, 0);
        setTimeout(() => {
            htmx.ajax("GET", "<?php echo $option['path']; ?>", "<?php echo appConfigPage::pageMain; ?>");
        }, "800");
    }());
</script>