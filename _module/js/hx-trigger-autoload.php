<?php
//======================================================================
// javascript：コンテンツ読込後、data-hx-trigger要素を自動で発火
//======================================================================
?>
<script>
    (function() {
        const elem = {
            dataHxGet: '[data-hx-get]',
            dataHxTrigger: '[data-hx-trigger]'
        }
        const triggerparam = 'every';
        document.querySelectorAll(elem.dataHxTrigger).forEach(function(selecter) {
            const getUrl = selecter.getAttribute(dataAttribute(elem.dataHxGet));
            const getTrigger = selecter.getAttribute(dataAttribute(elem.dataHxTrigger));
            if (getTrigger.includes(triggerparam)) {
                htmx.ajax('GET', getUrl, selecter)
            }
        });
    }());
</script>