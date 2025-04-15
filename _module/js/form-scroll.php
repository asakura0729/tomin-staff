<?php
//======================================================================
// javascript：対応ログ用フォームの横スクロール処理
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    (function() {
        let scrollVal = 0;
        const targetId = "<?php echo $option['target']; ?>";
        const elem = {
            dataHxPost: '[data-hx-post]',
            dataScroll: '[data-scroll]',
        }
        const getScrollX = function() {
            const targetElem = document.querySelector(targetId);
            const scrollElem = targetElem.querySelector(elem.dataScroll);
            scrollElem.addEventListener("scroll", () => {
                scrollVal = scrollElem.scrollLeft;
            });
        }
        const setScrollX = function(event) {
            const targetForm = document.querySelector(targetId + ' form');
            const scrollElem = targetForm.querySelector(elem.dataScroll);
            const dataHxPost = elem.dataHxPost.replace(/^\[|\]$/g, '');
            const hxPost = targetForm.getAttribute(dataHxPost);
            if (event.detail.pathInfo.requestPath === hxPost) {
                targetForm.querySelector(elem.dataScroll).scrollLeft = scrollVal;
                return getScrollX();
            }
        }
        getScrollX();
        document.querySelector(targetId).addEventListener('htmx:afterSwap', function(event) {
            return setScrollX(event);
        });
    }());
</script>