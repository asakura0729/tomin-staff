<?php
//======================================================================
// javascript：コンテンツ読込後、SUBMITを実行
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    setTimeout(() => {
        const target = "<?php echo $option['target']; ?>";
        document.querySelector(target).click();
    }, "500");
</script>