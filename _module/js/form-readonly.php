<?php
//======================================================================
// javascript：指定したフォームを閲覧専用にする
// カスタム要素：$option['target']...セレクタ要素(親)
// カスタム要素：$option['child']...セレクタ要素(子)...任意
//======================================================================
?>
<script>
    (function() {
        const targetId = "<?php echo $option['target']; ?>";
        const targetForm = document.querySelector(targetId);
        const childInput = "<?php echo appFuncArray::issetKey($option, 'child', ''); ?>";

        if (childInput != '') {
            targetForm.querySelectorAll(childInput).forEach(elem => {
                elem.classList.add('is-readonly');
                elem.readOnly = true;
            });
        } else {
            targetForm.querySelectorAll('select,textarea,input,button').forEach(elem => {
                elem.classList.add('is-readonly');
                elem.readOnly = true;
            });
        }

    }());
</script>