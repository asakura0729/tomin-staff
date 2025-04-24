<?php
//======================================================================
// 検索結果一覧　ヘッダ要素
// $option['key'] => 走査中のキー
// $option['inputType'] => inputType
// $option['dbTable'] => 走査中のテーブル
// $option['title'] => 表題
// $option['dataWidth'] => 横幅
// $option['rowCategory']=> 列カテゴリ
//======================================================================
?>
<?php if ($option['rowCategory'] != null) : ?>
    <?php /*分岐1：大カテゴリを表示*/ ?>
    <?php if ($option['key'] != array_key_first($option['dbTable'])) : ?>
        <?php /*分岐1-1：値は最初以外*/ ?>
        </div>
        </div>
    <?php endif; ?>

    <div class="<?php echo $option['rowCategory']['css']; ?> border-bottom">
        <h3 class="font-size-0_9 m-0 p-1 text-center border-bottom border-right">
            <?php echo $option['rowCategory']['title']; ?>
        </h3>
        <div class="d-flex">
        <?php endif; ?>

        <?php if ($option['key'] === array_key_first($option['dbTable'])): ?>
            <?php /*分岐2：値は最初*/ ?>
            <div data-width="50" class="p-1 text-center font-size-0_9 border-right border-bottom">ID</div>
        <?php endif; ?>

        <?php if ($option['inputType'] != '' && $option['inputType'] != 'hidden'): ?>
            <?php /*分岐3：要素が存在*/ ?>
            <div data-width="<?php echo $option['dataWidth']; ?>" class="p-1 text-center font-size-0_9 border-right border-bottom">
                <?php echo $option['title']; ?>
            </div>
        <?php endif; ?>

        <?php if ($option['key'] === array_key_last($option['dbTable'])) : ?>
            <?php /*分岐4：値は末尾*/ ?>
        </div>
    </div>
<?php endif; ?>