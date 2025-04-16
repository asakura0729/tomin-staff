<?php
//======================================================================
// javascript：ページ読み込み直後、フォームの送信
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    setTimeout(() => {
        const formId = "<?php echo $option['target']; ?>";
        const dataHxTarget = 'data-hx-target';
        const searchBtn = "[data-submit-search]";
        const form = document.querySelector(formId);
        const hxTarget = form.getAttribute(dataHxTarget);
        if (!!form.querySelector(searchBtn) === true) {
            form.querySelector(searchBtn).click();
        }
    }, "500");
</script>