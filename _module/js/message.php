<?php
//======================================================================
// javascript：メッセージ表示
// カスタム要素：$option['target']...セレクタ要素
// カスタム要素：$option['msg']...表示したいメッセージ
//======================================================================
?>
<script>
    (function() {
        const target = document.querySelectorAll("<?php echo $option['target']; ?>");
        const msg = "<?php echo $option['msg']; ?>";
        target.forEach(function(selecter) {
            selecter.textContent = msg;
        });
    }());
</script>