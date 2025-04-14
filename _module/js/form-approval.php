<?php
//======================================================================
// javascript：ログチェック用フォームの制御
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>
<script>
    (function() {
        const targetForm = document.querySelector("<?php echo appConfigSite::secCsEdit; ?>");
        const targetList = document.querySelector("<?php echo appConfigSite::secCsIndex; ?>");
        const elem = {
            dataEditApproval: '[data-edit-approval]',
            dataHxGet: '[data-hx-get]',
            dataHxPost: '[data-hx-post]',
            inputCsId: 'input[name="cs_id"]',
            inputApprovalStatus: 'input[name="approval_status"]'
        }
        const async = {
            count: "<?php echo appRoutesWeb::async['adminCount_approval']['contents']; ?>"
        }
        const submitFormApproval = function(btn) {
            const dataEditApproval = elem.dataEditApproval.replace(/^\[|\]$/g, '');
            const editApprovalJSON = btn.getAttribute(dataEditApproval);
            const editApproval = JSON.parse(editApprovalJSON);
            const csId = editApproval.cs_id;
            const approvalStatus = editApproval.approval_status;
            document.querySelector(elem.inputCsId).value = csId;
            document.querySelector(elem.inputApprovalStatus).value = approvalStatus;
            targetList.innerHTML = '';
            targetForm.addEventListener('htmx:afterSwap', function(event) {
                return changeAdminCountApproval(event);
            });
            targetForm.dispatchEvent(new Event("submit", {
                bubbles: true
            }));
        }
        const changeAdminCountApproval = function(event) {
            const dataHxPost = elem.dataHxPost.replace(/^\[|\]$/g, '');
            const hxPost = targetForm.getAttribute(dataHxPost);
            if (event.detail.pathInfo.requestPath === hxPost) {
                const dataHxGet = elem.dataHxGet.replace(/^\[|\]$/g, '');
                document.querySelectorAll(elem.dataHxGet).forEach(function(hxGetElem) {
                    const getUrl = hxGetElem.getAttribute(dataHxGet);
                    if (getUrl === async.count) {
                        htmx.ajax('GET', async.count, hxGetElem);
                    }
                });
            }
        }
        document.querySelectorAll(elem.dataEditApproval).forEach(function(btn) {
            btn.addEventListener("click", function() {
                return submitFormApproval(btn);
            });
        });
    }());
</script>