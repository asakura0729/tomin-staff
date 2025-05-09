<?php
//======================================================================
// javascript：編集ページの外に移動する際の確認ダイアログ
//======================================================================
?>
<script>
    (function() {
        const elem = {
            main: '<?php echo appConfigSite::pageMain; ?>',
            spinners: '<?php echo appConfigSite::spinners; ?>',
            dataHxPushUrl: '[data-hx-push-url]'
        }
        const css = {
            dNone: 'd-none',
        }
        const targetElem = document.querySelector(elem.main);
        const addDom = function(id) {
            const newDiv = document.createElement('div');
            newDiv.id = id;
            targetElem.appendChild(newDiv); 
        }
        const randomStr = function(length) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const array = new Uint8Array(length);
            crypto.getRandomValues(array);
            return Array.from(array, x => chars[x % chars.length]).join('');
        }
        const openComfirm = function(event, elemId) {
            const triggeringElement = event.detail.elt;
            if (triggeringElement.matches(elem.dataHxPushUrl) && document.getElementById(elemId) !== null) {
                if (!confirm('保存されていない編集中の内容は破棄されます。他のページに移動しますか？')) {
                    event.preventDefault();
                    setTimeout(function() {
                        document.querySelector(elem.spinners).classList.add(css.dNone);
                    }, 500);
                }
            }
        }
        const setComfirm = function() {
            let addDomId = 'elem-' + randomStr(12);
            addDom(addDomId);
            console.log(addDomId);
            document.body.addEventListener('htmx:configRequest', function(event) {
                return openComfirm(event, addDomId);
            });
        }
        setComfirm();
    }());
</script>