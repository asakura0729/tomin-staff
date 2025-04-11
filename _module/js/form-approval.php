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
            inputCsId: 'input[name="cs_id"]',
            inputApprovalStatus: 'input[name="approval_status"]'
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
            targetForm.dispatchEvent(new Event("submit", {
                bubbles: true
            }));
        }
        document.querySelectorAll(elem.dataEditApproval).forEach(function(btn) {
            btn.addEventListener("click", function() {
                return submitFormApproval(btn);
            });
        });
    }());
</script>