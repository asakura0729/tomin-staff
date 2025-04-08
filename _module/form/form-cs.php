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
    <div class="<?php echo appFuncCrmForm::setRowWidth($inputName, $inputType); ?> border bg-llgray font-size-0_9" data-disp="<?php echo appFuncCrmForm::setDataDisp($inputName); ?>">
        <h3 class="m-0 p-2 text-center font-size-0_9 bg-base border-bottom"><?php echo appFuncCrmForm::title($inputName, $title); ?></h3>
        <?php if ($inputName === 'client_category'): ?>
            <?php /*分岐：ステータス選択*/ ?>
            <?php $modalId = "modal-" . appFuncString::randomText(); ?>
            <div class="form-sheets p-1">
                <div class="border-contrast bg-white">
                    <button class="btn form-sheets border-contrast color-contrast opacity-hover-075" type="button" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                        <?php echo appFuncCrmForm::modalBtnStr($inputValue, $selectItem, $selectItemString); ?>
                    </button>
                </div>
            </div>
            <?php appFuncModule::modal('client_category', $modalId, ['value' => $inputValue]); ?>
        <?php elseif ($inputType === 'textarea'): ?>
            <?php /*分岐：テキストエリア*/ ?>
            <div class="<?php echo $colClass; ?>"><textarea name="<?php echo $inputName; ?>" class="form-sheets"><?php echo $inputValue; ?></textarea></div>
        <?php elseif ($inputType === 'checkbox'): ?>
            <?php /*分岐：チェックボックス*/ ?>
            <div class="form-sheets position-relative">
                <label class="pos-middle-center w-80per">
                    <input name="<?php echo $inputName; ?>" type="<?php echo $inputType; ?>" value="<?php echo appConfigStatus::delivery_status['required']; ?>" class="form-control" <?php if ($inputValue != ''): ?>checked<?php endif; ?>>
                </label>
            </div>
        <?php elseif ($inputType === 'select'): ?>
            <?php /*分岐：セレクトメニュー*/ ?>
            <div class="<?php echo $colClass; ?>">
                <select name="<?php echo $inputName; ?>" class="form-sheets">
                    <?php if ($selectItemNoValue === true): ?>
                        <option value="">指定なし</option>
                    <?php endif; ?>
                    <?php echo appFuncCrmForm::selectMenu($inputValue, $selectItem, $selectItemString); ?>
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