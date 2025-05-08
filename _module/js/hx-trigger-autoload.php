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
        const attributeGet = elem.dataHxGet.replace(/^\[|\]$/g, '');
        const attributeTrigger = elem.dataHxTrigger.replace(/^\[|\]$/g, '');
        document.querySelectorAll(elem.dataHxTrigger).forEach(function(selecter) {
            const getUrl = selecter.getAttribute(attributeGet);
            const getTrigger = selecter.getAttribute(attributeTrigger);
            if (getTrigger.includes(triggerparam)) {
                htmx.ajax('GET', getUrl, selecter)
            }
        });
    }());
</script>