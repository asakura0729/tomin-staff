<div class="p-1 animation-fadein" data-item>
    <div class="p-1 bg-white row no-gutters">
        <div class="col-9 col-lg-11"><?php appLibraryDisp::form('text', $option['inputName'], '追加アイテム', $option['value'], ['placeholder' => 'テキストを記入']); ?> </div>
        <div class="col-3 col-lg-1 text-center"><?php appLibraryDisp::globalModule('form/btn_del', ['add' => 'data-item-del']); ?></div>
    </div>
</div>