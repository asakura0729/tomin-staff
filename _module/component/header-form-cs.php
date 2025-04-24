<?php
//======================================================================
// 入力フォーム（対応ログ編集・検索用）　ヘッダ要素
// $option['key'] => 走査中のキー
// $option['inputName'] => name属性,
// $option['inputType'] => inputType,
// $option['dbTable'] => 走査中のテーブル,
// $option['title'] => 表題,
// $option['rowCategory']=> 列カテゴリ
//======================================================================
?>
<?php if (isset($option['rowCategory']) && $option['rowCategory'] != null) : ?>
    <?php /*分岐1：大カテゴリを表示*/ ?>
    <?php if ($option['key'] != array_key_first($option['dbTable'])) : ?>
        <?php /*分岐1-1：値は最初以外*/ ?>
        </div>
        </div>
    <?php endif; ?>

    <div class="<?php echo $option['rowCategory']['css']; ?> border-bottom">
        <h3 class="position-relative m-0 pt-3 pb-3 border-bottom border-right font-size-0_9 text-center overflow-hidden">
            <span class="pos-middle-center d-block w-300px"><?php echo $option['rowCategory']['title']; ?></span>
        </h3>
        <div class="d-flex">
        <?php endif; ?>

        <?php if ($option['inputType'] != 'hidden' && $option['inputType'] != ''): ?>
            <div class="<?php echo appFuncCrmDisp::setFormRowWidth($option['inputName'], $option['inputType']); ?> border font-size-0_9" data-wrap-disp="<?php echo appFuncCrmDisp::setDataDisp($option['key']); ?>" data-wrap-inputname="<?php echo $option['key']; ?>">
                <h4 class="m-0 p-2 text-center font-size-0_9 border-bottom">
                    <?php echo $option['title']; ?>
                </h4>
            <?php endif; ?>