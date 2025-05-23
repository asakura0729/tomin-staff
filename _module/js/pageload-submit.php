<?php
//======================================================================
// javascript：コンテンツ読込後、SUBMITを実行
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    (function() {
        const target = "<?php echo $option['target']; ?>";
        setTimeout(() => {
            if (!!document.querySelector(target) === true) {
                document.querySelector(target).click();
            }
        }, "500");
    }());
</script>