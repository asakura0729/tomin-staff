<?php
//======================================================================
// javascript：ページ読み込み直後、フォームを自動送信
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    setTimeout(() => {
        const formId = "<?php echo $option['target']; ?>";
        const searchBtn = "[data-submit-search]";
        if (!!document.querySelector(formId) === true) {
            document.querySelector(formId).querySelector(searchBtn).click();
        }
    }, "500");
</script>