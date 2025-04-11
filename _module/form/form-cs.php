<?php
//======================================================================
// 入力フォーム（対応ログ編集・検索用）
//======================================================================
?>
<?php $colClass = "p-1 cursor-pointer h-100 position-relative"; ?>

<?php if ($inputType === ''): ?>
    <?php /*分岐：入力要素なし*/ ?>
    <!--<?php echo $inputName; ?>／<?php echo $inputValue; ?>-->
<?php elseif ($inputType === 'hidden'): ?>
    <?php /*分岐：非表示*/ ?>
    <input type="hidden" name="<?php echo $inputName; ?>" value="<?php echo $inputValue; ?>">
<?php else: ?>
    <div class="<?php echo appFuncCrmDisp::setRowWidth($inputName, $inputType); ?> border bg-llgray font-size-0_9" data-disp="<?php echo appFuncCrmDisp::setDataDisp($inputName); ?>" data-wrap-inputname="<?php echo $inputName; ?>">
        <h4 class="m-0 p-2 text-center font-size-0_9 bg-base border-bottom">
            <?php echo $title; ?>
        </h4>
        <?php if ($inputName === appDatabaseCs::table['client_category']['name']): ?>
            <?php /*分岐：ステータス選択*/ ?>
            <div class="form-sheets p-1">
                <div class="border-contrast bg-white">
                    <button data-modal class="btn form-sheets border-contrast color-contrast opacity-hover-075" type="button">
                        <?php echo appFuncCrmDisp::modalBtnStr($inputValue, $selectItem, $selectItemString); ?>
                    </button>
                </div>
            </div>
        <?php elseif (
            appConfigPage::$path === appRoutesWeb::sitemap['adminCsEdit']['contents'] && $inputName === appDatabaseCs::table['approval_status']['name'] ||
            appConfigPage::$path === appRoutesWeb::async['adminCsAjaxPost']['contents'] && $inputName === appDatabaseCs::table['approval_status']['name']
        ): ?>
            <?php /*分岐：申請*/ ?>
            <div class="form-sheets position-relative text-center">
                <label class="pos-middle-center w-80per">
                    <?php if ($inputValue != appConfigStatus::approval_status['complete']['key']): ?>
                        <?php /*分岐1：申請中*/ ?>
                        <input type="checkbox" class="form-control" <?php echo appFuncCrmDisp::checkbox($inputName, $inputValue, appConfigStatus::approval_status['progress']['key'], appConfigStatus::approval_status['started']['key']); ?>>
                        <input name="<?php echo $inputName; ?>" type="hidden" value="<?php echo $inputValue; ?>">
                    <?php else: ?>
                        <?php /*分岐2：未申請*/ ?>
                        <input type="checkbox" class="form-control" checked disabled>
                        <span class="pt-1 d-block"><?php echo appConfigStatus::approval_status['complete']['name']; ?></span>
                    <?php endif; ?>
                </label>
            </div>
        <?php elseif ($inputName === appDatabaseCs::table['delivery_status']['name']): ?>
            <?php /*分岐：資料請求*/ ?>
            <div class="form-sheets position-relative">
                <label class="pos-middle-center w-80per">
                    <input type="checkbox" class="form-control" <?php echo appFuncCrmDisp::checkbox($inputName, $inputValue, appConfigStatus::delivery_status['required']['key'], appConfigStatus::delivery_status['unnecessary']['key']); ?>>
                    <input name="<?php echo $inputName; ?>" type="hidden" value="<?php echo $inputValue; ?>">
                </label>
            </div>
        <?php elseif ($inputType === 'textarea'): ?>
            <?php /*分岐：テキストエリア*/ ?>
            <div class="<?php echo $colClass; ?>"><textarea name="<?php echo $inputName; ?>" class="form-sheets font-size-0_9"><?php echo $inputValue; ?></textarea></div>
        <?php elseif ($inputType === 'select'): ?>
            <?php /*分岐：セレクトメニュー*/ ?>
            <div class="<?php echo $colClass; ?>">
                <select name="<?php echo $inputName; ?>" class="form-sheets">
                    <?php if ($selectItemNoValue === true): ?>
                        <option value="">指定なし</option>
                    <?php endif; ?>
                    <?php echo appFuncCrmDisp::selectMenu($inputValue, $selectItem, $selectItemString); ?>
                </select>
            </div>
        <?php else: ?>
            <?php /*分岐：その他*/ ?>
            <div class="<?php echo $colClass; ?>">
                <input name="<?php echo $inputName; ?>" type="<?php echo $inputType; ?>" value="<?php echo $inputValue; ?>" class="form-sheets">
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

