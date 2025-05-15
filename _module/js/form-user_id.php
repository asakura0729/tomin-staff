<?php
//======================================================================
// javascript：指定した要素にuser_idを適用
// カスタム要素：$option['target']...セレクタ要素(親)
// カスタム要素：$option['child']...セレクタ要素(子)...任意
//======================================================================
?>
<script>
    (function() {
        const elem = {
            headerForm: "<?php echo appConfigSite::pageHeaderForm; ?>",
            targetForm: "<?php echo $option['target']; ?>"
        }
        const input = {
            userId: 'input[name=userid]',
            targetInput: '<?php echo $option['child']; ?>',
        }
        const setUserId = function() {
            if (!!document.querySelector(elem.headerForm) === true) {
                const userId = document.querySelector(elem.headerForm).querySelector(input.userId).value;
                document.querySelector(elem.targetForm).querySelector(input.targetInput).value = userId;
            } else {
                return setTimeout(function() {
                    setUserId();
                }, 100);
            }
        }
        setUserId();
    }());
</script>