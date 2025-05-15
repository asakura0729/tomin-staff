<?php
//======================================================================
// 入力フォーム（対応ログ編集・検索用）
//======================================================================
?>

<?php if ($inputType === '' || $inputType === 'hidden'): ?>
    <?php /*分岐1：非表示*/ ?>
    <input type="hidden" name="<?php echo $inputName; ?>" value="<?php echo $inputValue; ?>">
<?php else: ?>
    <?php /*分岐2：表示*/ ?>
    <?php if ($inputName === appDatabaseCs::table['client_category']['name']): ?>
        <?php /*分岐：ステータス選択*/ ?>
        <div class="border-contrast bg-white">
            <button data-modal class="btn form-sheets border-contrast color-contrast opacity-hover-075" type="button">
                <?php echo appFuncCrmDisp::modalBtnStr($inputValue, $selectItem, $selectItemString); ?>
            </button>
        </div>
    <?php elseif ($inputType === 'checkbox' && $inputName === appDatabaseCs::table['approval_status']['name']): ?>
        <?php /*分岐：申請*/ ?>
        <div class="bg-white position-relative p-1 form-sheets">
            <div class="pos-middle-center w-80per text-center">
                <?php if ($inputValue != appConfigStatus::approval_status['complete']['key']): ?>
                    <?php /*分岐1：申請中*/ ?>
                    <?php echo appConfigStatus::approval_status['progress']['name']; ?>
                    <input name="<?php echo $inputName; ?>" type="hidden" value="<?php echo $inputValue; ?>">
                <?php else: ?>
                    <?php /*分岐2：申請済*/ ?>
                    <input type="checkbox" class="form-control" checked disabled>
                    <span class="pt-1 d-block" data-disp="approval_by"></span>
                <?php endif; ?>
            </div>
        </div>
    <?php elseif ($inputType === 'checkbox' && $inputName === appDatabaseCs::table['delivery_status']['name']): ?>
        <?php /*分岐：資料請求*/ ?>
        <div class="bg-white position-relative p-1 form-sheets">
            <div class="pos-middle-center w-80per text-center">
                <input type="checkbox" class="form-control" <?php echo appFuncCrmDisp::checkbox($inputName, $inputValue, appConfigStatus::delivery_status['required']['key'], appConfigStatus::delivery_status['unnecessary']['key']); ?>>
                <input name="<?php echo $inputName; ?>" type="hidden" value="<?php echo $inputValue; ?>">
            </div>
        </div>
    <?php elseif ($inputType === 'date-range'): ?>
        <?php /*分岐：日付（範囲指定）*/ ?>
        <input name="<?php echo $inputName; ?>[min]" type="date" value="" class="form-control" data-input-date="<?php echo $inputName; ?>">
        <input name="<?php echo $inputName; ?>[max]" type="date" value="" class="form-control" data-input-date="<?php echo $inputName; ?>" readonly>
    <?php elseif ($inputType === 'select'): ?>
        <?php /*分岐：セレクトメニュー*/ ?>
        <select name="<?php echo $inputName; ?>" class="form-sheets">
            <?php if ($selectItemNoValue === true): ?>
                <option value="">指定なし</option>
            <?php endif; ?>
            <?php echo appFuncCrmDisp::selectMenu($inputValue, $selectItem, $selectItemString); ?>
        </select>
    <?php elseif ($inputType === 'number'): ?>
        <?php /*分岐：数値*/ ?>
        <input name="<?php echo $inputName; ?>" type="text" value="<?php echo $inputValue; ?>" class="form-sheets text-right p-1" data-input-number>
    <?php elseif ($inputType === 'datetime-local' || $inputType === 'date'): ?>
        <?php /*分岐：日付*/ ?>
        <input name="<?php echo $inputName; ?>" type="<?php echo $inputType; ?>" value="<?php echo $inputValue; ?>" class="form-sheets">
    <?php else: ?>
        <?php /*分岐：その他*/ ?>
        <textarea name="<?php echo $inputName; ?>" class="form-sheets font-size-0_9 p-1"><?php echo $inputValue; ?></textarea>
    <?php endif; ?>
<?php endif; ?>