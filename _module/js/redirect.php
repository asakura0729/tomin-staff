<?php
//======================================================================
// javascript：コンテンツ読込後、リダイレクト実行
// $option['path']...リダイレクト先URL
//======================================================================
?>
<script>
    (function() {
        window.scrollTo(0, 0);
        htmx.ajax("GET", "<?php echo $option['path']; ?>", "<?php echo appConfigSite::pageMain; ?>");
    }());
</script>