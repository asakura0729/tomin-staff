<?php
//======================================================================
// javascript：フォーム送信時、CSVダウンロード処理を行う
//======================================================================
?>
<script>
    (function() {
        const action = "<?php echo appRoutesWeb::async['adminDownload']['contents']; ?>?";
        const downloadBtn = "[data-submit-download]";
        const searchBtn = "[data-submit-search]";
        const inputDownload = "input[name=download_flg]";
        const data = {};

        const downloadCsv = function(selecter) {
            const form = selecter.closest("form");
            const formData = new FormData(form);
            for (const [key, value] of formData.entries()) {
                if (data[key] !== undefined) {
                    if (!Array.isArray(data[key])) {
                        data[key] = [data[key]];
                    }
                    data[key].push(value);
                } else {
                    data[key] = value;
                }
            }
            location.href = action + toQueryString(data);
        }

        const toQueryString = function(data) {
            const params = new URLSearchParams();
            for (const key in data) {
                const value = data[key];
                if (Array.isArray(value)) {
                    for (const v of value) {
                        params.append(key, v);
                    }
                } else {
                    params.append(key, value);
                }
            }
            return params.toString();
        }

        if (!!document.querySelector(downloadBtn) === true) {
            document.querySelectorAll(downloadBtn).forEach(function(selecter) {
                selecter.addEventListener("click", function() {
                    return downloadCsv(this);
                });
            });
        }
    }());
</script>