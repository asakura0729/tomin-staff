<?php
//======================================================================
//モーダル：ステータス選択
//$option['modalId']...モーダルウインドウのID
//$option['inputName']...入力フォームのキー
//$option['inputValue']...入力フォームの値
//======================================================================
?>

<?php /*分岐：ステータス選択*/ ?>
<div class="modal" id="<?php echo $option['modalId']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <header class="d-flex flex-row-reverse border-bottom">
                <button type="button" class="close p-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            <div class="row p-4 pb-5">
                <div class="col-6">
                    <?php appFuncModule::heading('h2', 'h3', '有効注文', ['css' => 'text-center']); ?>
                    <?php foreach (appConfigStatus::clientCategory as $itemKey => $item): ?>
                        <?php if ($item['type'] === appConfigStatus::clientCategoryValid): ?>
                            <label class="d-block m-0 p-2 border cursor-pointer <?php if ($option['inputValue'] === $item['key']): ?>bg-lgreen<?php endif; ?>" data-label-client_category="<?php echo appConfigStatus::clientCategoryValid; ?>">
                                <input type="radio" name="client_category" value="<?php echo $itemKey; ?>" data-toggle-row='{"target":"[data-wrap-disp=<?php echo appConfigStatus::clientCategoryValid; ?>]","disp":true}' <?php if ($option['inputValue'] === (string)$itemKey): ?>checked<?php endif; ?>>
                                <?php echo $item['name']; ?>
                            </label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-6" data-wrap-client_category="<?php echo appConfigStatus::clientCategoryInvalid; ?>">
                    <?php appFuncModule::heading('h2', 'h3', '無効注文', ['css' => 'text-center']); ?>
                    <?php foreach (appConfigStatus::clientCategory as $itemKey => $item): ?>
                        <?php if ($item['type'] === appConfigStatus::clientCategoryInvalid): ?>
                            <label class="d-block m-0 p-2 border cursor-pointer <?php if ($option['inputValue'] === $item['key']): ?>bg-lgreen<?php endif; ?>" data-label-client_category="<?php echo appConfigStatus::clientCategoryInvalid; ?>">
                                <input type="radio" name="client_category" value="<?php echo $itemKey; ?>" data-toggle-row='{"target":"[data-wrap-disp=<?php echo appConfigStatus::clientCategoryValid; ?>]","disp":false}' <?php if ($option['inputValue'] === (string)$itemKey): ?>checked<?php endif; ?>>
                                <?php echo $item['name']; ?>
                            </label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>