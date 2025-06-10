<?php
//======================================================================
// javascript：テーブルカラムのリサイズ要素
//======================================================================
?>
<script>
    (function() {
        const dataCol = '[data-col]';
        const dataRowResize = '[data-row-resize]';
        let isResizing = false;
        let selectDataRowInner = '';
        elem.main.querySelectorAll(dataRowResize).forEach(resizer => {
            resizer.addEventListener('mousedown', (event) => {
                isResizing = true;
                selectDataRowInner = resizer.previousElementSibling;
            });
        });
        elem.main.addEventListener('mousemove', function(e) {
            if (!isResizing) return;
            const parentCol = selectDataRowInner.closest(dataCol);
            const rect = selectDataRowInner.getBoundingClientRect();
            let newHeight = e.clientY - rect.top;
            if (newHeight < 50) newHeight = 50;
            selectDataRowInner.style.height = `${newHeight}px`;
            if (parentCol) {
                parentCol.querySelectorAll(dataRowResize).forEach(resizer => {
                    resizer.previousElementSibling.style.height = `${newHeight}px`;
                });
            }
        });
        elem.main.addEventListener('mouseup', function() {
            if (isResizing) {
                isResizing = false;
            }
        });
    }());
</script>