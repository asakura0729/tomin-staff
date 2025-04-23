<?php
//======================================================================
// 入力フォーム（対応ログ編集・検索用）　ヘッダ要素
//======================================================================
?>
<?php if (isset(appDatabaseCs::rowCategory[$option['key']]) || $option['key'] === array_key_first($option['dbTable'])) : ?>
    <?php /*分岐：値が存在*/ ?>
    <?php if ($option['key'] != array_key_first($option['dbTable'])) : ?>
        <?php /*分岐：値は最初以外*/ ?>
        </div>
        </div>
    <?php endif; ?>

    <?php $bgCss = appDatabaseCs::rowCategory[$option['key']]['css']; ?>
    <div class="<?php echo $bgCss; ?> border-bottom">
        <h3 class="position-relative m-0 pt-3 pb-3 border-bottom border-right font-size-0_9 text-center overflow-hidden">
            <span class="pos-middle-center d-block w-300px"><?php echo appDatabaseCs::rowCategory[$option['key']]['title']; ?></span>
        </h3>
        <div class="d-flex">
        <?php endif; ?>

        <?php if ($option['inputType'] != 'hidden' && $option['inputType'] != ''): ?>
            <div class="<?php echo appFuncCrmDisp::setFormRowWidth($option['inputName'], $option['inputType']); ?> border font-size-0_9" data-wrap-disp="<?php echo appFuncCrmDisp::setDataDisp($option['inputName']); ?>" data-wrap-inputname="<?php echo $option['inputName']; ?>">
                <h4 class="m-0 p-2 text-center font-size-0_9 border-bottom">
                    <?php echo $option['title']; ?>
                </h4>
            <?php endif; ?>