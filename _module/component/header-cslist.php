<?php
//======================================================================
// 検索結果一覧　ヘッダ要素
//======================================================================
?>
<?php if (isset(appDatabaseCs::rowCategory[$option['key']]) || $option['key'] === array_key_first($option['dbTable'])) : ?>
    <?php /*分岐：値が存在*/ ?>
    <?php if ($option['key'] != array_key_first($option['dbTable'])) : ?>
        <?php /*分岐：値は最初以外*/ ?>
        </div>
        </div>
    <?php endif; ?>

    <div class="<?php echo appDatabaseCs::rowCategory[$option['key']]['css']; ?> border-bottom">
        <h3 class="font-size-0_9 m-0 p-1 text-center border-bottom border-right">
            <?php echo appDatabaseCs::rowCategory[$option['key']]['title']; ?>
        </h3>
        <div class="d-flex">
        <?php endif; ?>

        <?php if ($option['key'] === array_key_first($option['dbTable'])): ?>
            <?php /*分岐：値は最初*/ ?>
            <div data-width="50" class="p-1 text-center font-size-0_9 border-right border-bottom">ID</div>
        <?php endif; ?>

        <?php if ($option['input'] != '' && $option['input'] != 'hidden'): ?>
            <?php /*分岐：要素を表示*/ ?>
            <div data-width="<?php echo $option['dataWidth']; ?>" class="p-1 text-center font-size-0_9 border-right border-bottom">
                <?php echo $option['title']; ?>
            </div>
        <?php endif; ?>

        <?php if ($option['key'] === array_key_last($option['dbTable'])) : ?>
            <?php /*分岐：値は末尾*/ ?>
        </div>
    </div>
<?php endif; ?>