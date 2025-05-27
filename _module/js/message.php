<?php
//======================================================================
// javascript：コンテンツ読込後、メッセージ表示
// カスタム要素：$option['target']...セレクタ要素
// カスタム要素：$option['msg']...表示したいメッセージ
//======================================================================
?>
<script>
    (function() {
        const target = "<?php echo $option['target']; ?>";
        const msg = "<?php echo $option['msg']; ?>";
        if (!!document.querySelectorAll(target) === true) {
            document.querySelectorAll(target).forEach(function(selecter) {
                selecter.textContent = msg;
            });
        }
    }());
</script>