<?php
//======================================================================
// 入力フォーム（対応ログ編集・検索用）　ヘッダ要素
// $option['key'] => 走査中のキー
// $option['inputName'] => name属性,
// $option['inputType'] => inputType,
// $option['dbTable'] => 走査中のテーブル,
// $option['dbResult'] => DB取得結果,
// $option['title'] => 表題,
// $option['rowCategory']=> 列カテゴリ
// $option['dbPost']=> データベース送信の有無(bool)
//======================================================================
?>
<?php if (isset($option['rowCategory']) && $option['rowCategory'] != null) : ?>
    <?php /*分岐1：大カテゴリを表示*/ ?>
    <?php if ($option['key'] != array_key_first($option['dbTable'])) : ?>
        <?php /*分岐1-1：値は最初以外*/ ?>
        </div>
        </div>
    <?php endif; ?>

    <?php if ($option['dbPost'] === true && $option['rowCategory']['key'] === appFuncCrmArray::rows['cs_tel']['key']): ?>
        <?php /*分岐2：データベース送信あり + 架電フォーム*/ ?>
        <button type="button" class="m-1 btn border-contrast color-contrast opacity-hover-075 bg-white position-relative" data-toggle-accordion="<?php echo appFuncCrmDisp::accordion($option['dbResult'], $option['key'], appConfigStatus::cs_tel_status['unnecessary']['key']); ?>"></button>
    <?php endif; ?>

    <div class="<?php echo $option['rowCategory']['css']; ?> border-bottom">
        <h3 class="position-relative m-0 pt-3 pb-3 border-bottom border-right font-size-0_9 text-center overflow-hidden">
            <span class="pos-middle-center d-block w-300px"><?php echo $option['rowCategory']['title']; ?></span>
        </h3>
        <div class="d-flex">
        <?php endif; ?>

        <?php if ($option['inputType'] != 'hidden' && $option['inputType'] != ''): ?>
            <?php /*分岐3：表示される*/ ?>
            <div class="<?php echo appFuncCrmDisp::setFormRowWidth($option['inputName'], $option['inputType']); ?> border font-size-0_9" data-wrap-disp="<?php echo appFuncCrmDisp::setDataDisp($option['key']); ?>">
                <header class="d-flex justify-content-between border-bottom">
                    <h4 class="m-0 p-2 text-center font-size-0_9">
                        <?php echo $option['title']; ?>
                    </h4>
                    <?php if ($option['dbPost'] === true): ?>
                        <?php /*分岐3-1：データベース送信あり*/ ?>
                        <?php $selectMenu = appFuncCrmDisp::setSelectMenuAddToValue($option['inputName']); ?>
                        <?php if ($option['inputName'] === appDatabaseCs::table['chief_mourner_name']['name']): ?>
                            <?php /*分岐3-1-1：データベース送信あり＞喪主名*/ ?>
                            <button type="button" data-add-clone='{"target":"[name=<?php echo $option['inputName']; ?>]","clone":"[name=<?php echo appDatabaseCs::table['client_name']['name']; ?>]"}' class="btn border-contrast color-contrast bg-white opacity-hover-075 p-0 w-100px"><i class="fa fa-files-o pr-1" aria-hidden="true"></i>転記</button>
                        <?php elseif (!empty($selectMenu)): ?>
                            <?php /*分岐3-1-2：データベース送信あり＞value値追加セレクトメニューに値あり*/ ?>
                            <select data-add-select='[name="<?php echo $option['inputName']; ?>" ]' class="w-100px font-size-0_9 border rounded-0">
                                <option value="">選択</option>
                                <?php foreach ($selectMenu as $selectMenuVal): ?>
                                    <option value="<?php echo appFuncArray::issetKey($selectMenuVal, 'value', $selectMenuVal['name']); ?>"><?php echo $selectMenuVal['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    <?php endif; ?>
                </header>
            <?php endif; ?>