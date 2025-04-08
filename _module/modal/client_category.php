<?php
//======================================================================
//汎用モジュール：ステータス選択モーダル
//$option['value']...入力フォームの値
//======================================================================
?>
<div class="modal" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $id; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <header class="d-flex flex-row-reverse border-bottom">
                <button type="button" class="close p-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            <div class="p-4">
                <div class="row pb-5">
                    <div class="col-6">
                        <?php appFuncModule::heading('h2', 'h3', '有効注文', ['css' => 'text-center']); ?>
                        <?php foreach (appConfigStatus::clientCategory as $itemKey => $item): ?>
                            <?php if ($item['type'] === appConfigStatus::clientCategoryValid): ?>
                                <label class="d-block m-0 p-2 border cursor-pointer <?php if ($option['value'] === (string)$itemKey): ?>bg-lgreen<?php endif; ?>" data-label-client_category="<?php echo appConfigStatus::clientCategoryValid; ?>">
                                    <input type="radio" name="client_category" value="<?php echo $itemKey; ?>" data-toggle-row='{"target":"[data-disp=<?php echo appConfigStatus::clientCategoryValid; ?>]","disp":true}' <?php if ($option['value'] === (string)$itemKey): ?>checked<?php endif; ?>>
                                    <?php echo $item['name']; ?>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-6" data-wrap-client_category="<?php echo appConfigStatus::clientCategoryInvalid; ?>">
                        <?php appFuncModule::heading('h2', 'h3', '無効注文', ['css' => 'text-center']); ?>
                        <?php foreach (appConfigStatus::clientCategory as $itemKey => $item): ?>
                            <?php if ($item['type'] === appConfigStatus::clientCategoryInvalid): ?>
                                <label class="d-block m-0 p-2 border cursor-pointer <?php if ($option['value'] === (string)$itemKey): ?>bg-lgreen<?php endif; ?>" data-label-client_category="<?php echo appConfigStatus::clientCategoryInvalid; ?>">
                                    <input type="radio" name="client_category" value="<?php echo $itemKey; ?>" data-toggle-row='{"target":"[data-disp=<?php echo appConfigStatus::clientCategoryValid; ?>]","disp":false}' <?php if ($option['value'] === (string)$itemKey): ?>checked<?php endif; ?>>
                                    <?php echo $item['name']; ?>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>