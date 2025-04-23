<?php
//======================================================================
// javascript：リダイレクト
// $option['path']...リダイレクト先URL
//======================================================================
?>
<script>
    (function() {
        window.scrollTo(0, 0);
        htmx.ajax("GET", "<?php echo $option['path']; ?>", "<?php echo appConfigSite::pageMain; ?>");
    }());
</script>