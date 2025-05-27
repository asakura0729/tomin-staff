<?php
//======================================================================
// javascript：送客シート入力フォームの制御
// カスタム要素：$option['target']...セレクタ要素
//======================================================================
?>

<script>
    (function() {
        const targetForm = document.querySelector("<?php echo $option['target']; ?>");
        const elem = {
            inputPlan: '[name=<?php echo appDatabaseCs::table['plan_category']['name']; ?>]',
            inputDecRegion: '[name=<?php echo appDatabaseCs::table['dec_region']['name']; ?>]',
            inputFuneralDate: '[name=<?php echo appDatabaseCs::table['funeral_date']['name']; ?>]',
            inputHallName: '[name=<?php echo appDatabaseCs::table['hall_name']['name']; ?>]',
            inputCrematoryName: '[name=<?php echo appDatabaseCs::table['crematory_name']['name']; ?>]',
            inputDeliveryStatus: '[name=<?php echo appDatabaseCs::table['delivery_status']['name']; ?>]',
            inputOptionFlower: '[name=<?php echo appDatabaseCs::table['option_flower']['name']; ?>]',
        }
        const status = {
            deliveryStatusRequired: '<?php echo appConfigStatus::delivery_status['required']['key']; ?>'
        }
        
        <?php appFuncMinify::minifySourceStart(); ?>
        const kasouPlan = {
            <?php foreach (appConfigFuneral::plan as $key => $plan): ?>
                <?php if ($plan['optionFlower'] === false): ?>
                    <?php echo $key; ?>: "<?php echo $key; ?>",
                <?php endif; ?>
            <?php endforeach; ?>
        }
        <?php appFuncMinify::minifySourceEnd(); ?>

        const inputBlank = function(selecter, string) {
            const inputValue = selecter.value;
            if (inputValue === '') {
                selecter.value = string;
            }
        }
        const loadInputBlank = function(selecter, string) {
            const inputElem = targetForm.querySelector(selecter);
            inputBlank(inputElem, string);
            inputElem.addEventListener("change", function() {
                inputBlank(this, string);
            });
        }
        const inputOptionFlower = function() {
            const inputPlanVal = targetForm.querySelector(elem.inputPlan).value;
            const inputDeliveryStatusVal = targetForm.querySelector(elem.inputDeliveryStatus).value;
            const inputOptionFlower = targetForm.querySelector(elem.inputOptionFlower);
            optionFlowerVal = "なし";
            if (inputDeliveryStatusVal === status.deliveryStatusRequired) {
                /*判断：資料請求あり*/
                if (Object.values(kasouPlan).includes(inputPlanVal) === true) {
                    /*判断：葬儀なし*/
                    optionFlowerVal = "なし（資料請求いただいているお客様です。 プラン内容が変更になった場合は適宜ご対応お願いします）";
                } else {
                    /*判断：葬儀あり*/
                    optionFlowerVal = "★★★ 特典 あり ★★★";
                }
            }
            inputOptionFlower.value = "";
            setTimeout(() => {
                inputOptionFlower.value = optionFlowerVal;
            }, "500");
        }
        const loadInputOptionFlower = function() {
            inputOptionFlower();
            targetForm.querySelector(elem.inputPlan).addEventListener("change", function() {
                inputOptionFlower();
            });
        }
        loadInputBlank(elem.inputDecRegion, "未聴取");
        loadInputBlank(elem.inputFuneralDate, "未定");
        loadInputBlank(elem.inputHallName, "未定");
        loadInputBlank(elem.inputCrematoryName, "未定");
        loadInputBlank(elem.inputDecRegion, "未聴取");
        loadInputOptionFlower();
    }());
</script>