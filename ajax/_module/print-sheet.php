<div class="print_wrap mx-auto bg-white position-relative">
    <header class="pb-2">
        <h2 class="font-size-2 font-notoserif text-center"><?php appFuncModule::dbForm('title', $option); ?></h2>
    </header>

    <div class="d-none">
        <?php appFuncModule::dbForm('cs_id', $option); ?>
        <?php appFuncModule::dbForm('parent_cs_id', $option); ?>
        <?php appFuncModule::dbForm('cs_category', $option); ?>
        <?php appFuncModule::dbForm('approval_status', $option); ?>
    </div>

    <div class="d-flex justify-content-end pb-2 font-size-0_9">
        <div class="<?php if ($option['editFlg'] === true): ?>w-75<?php else: ?>w-300px<?php endif; ?>">
            <div class="row no-gutters align-items-center">
                <div class="col-5 text-right">日時：</div>
                <div class="col-7"><?php appFuncModule::dbForm('post_date', $option); ?></div>
            </div>
            <div class="row no-gutters align-items-center">
                <div class="col-5 text-right">担当者名：</div>
                <div class="col-7"><?php appFuncModule::dbForm('post_by', $option); ?></div>
            </div>
        </div>
    </div>

    <div class="pb-3">
        <div class="d-flex align-items-center w-40per pb-2">
            <?php appFuncModule::dbForm('funeral_name', $option); ?>
            <div class="w-100px pl-2">御中</div>
        </div>
        <p class="font-size-0_9 m-0 p-0">
            いつもお世話になっております。<br>
            下記の通り、ご依頼致しますので、ご対応をお願い致します。
        </p>
    </div>

    <h2 class="font-size-1">【依頼者】</h2>
    <table class="table table-sm table-bordered">
        <tr>
            <th class="w-20per text-center">名前</th>
            <td class="w-30per"><?php appFuncModule::dbForm('client_name', $option); ?></td>
            <th class="w-20per text-center">ご連絡先</th>
            <td class="w-30per"><?php appFuncModule::dbForm('client_tel', $option); ?></td>
        </tr>
    </table>

    <h2 class="font-size-1">【故人様】</h2>
    <table class="table table-sm table-bordered">
        <tr>
            <th class="w-20per text-center">故人名</th>
            <td class="w-30per"><?php appFuncModule::dbForm('dec_name', $option); ?></td>
            <th class="w-20per text-center">続柄</th>
            <td class="w-30per"><?php appFuncModule::dbForm('dec_relation', $option); ?></td>
        </tr>
    </table>

    <h2 class="font-size-1">【お迎え・葬儀希望地】</h2>
    <table class="table table-sm table-bordered">
        <tr>
            <th class="w-20per text-center">希望日</th>
            <td class="w-30per"><?php appFuncModule::dbForm('funeral_date', $option); ?></td>
            <th class="w-20per text-center">葬儀場</th>
            <td class="w-30per"><?php appFuncModule::dbForm('hall_name', $option); ?></td>
        </tr>
        <tr>
            <th class="w-20per text-center">住民票</th>
            <td class="w-30per"><?php appFuncModule::dbForm('dec_region', $option); ?></td>
            <th class="w-20per text-center">火葬場</th>
            <td class="w-30per"><?php appFuncModule::dbForm('crematory_name', $option); ?></td>
        </tr>
        <tr>
            <th class="w-20per text-center">ご安置</th>
            <td class="w-80per" colspan="3"><?php appFuncModule::dbForm('ensconce_category', $option); ?></td>
        </tr>
        <tr>
            <th class="w-20per text-center">お迎え場所</th>
            <td class="w-80per" colspan="3"><?php appFuncModule::dbForm('dest_address', $option); ?></td>
        </tr>
    </table>

    <h2 class="font-size-1">【葬儀内容】</h2>
    <table class="table table-sm table-bordered">
        <tr>
            <th class="w-20per text-center">葬儀プラン</th>
            <td class="w-80per"><?php appFuncModule::dbForm('plan_category', $option); ?></td>
        </tr>
        <tr>
            <th class="w-20per text-center">オプション</th>
            <td class="w-80per"><?php appFuncModule::dbForm('option_name', $option); ?></td>
        </tr>
        <tr>
            <th class="w-20per text-center">お花盆<br><span class="font-size-0_8">（プレゼント特典）</span></th>
            <td class="w-80per"><?php appFuncModule::dbForm('option_flower', $option); ?></td>
        </tr>
    </table>

    <div class="pt-3 pb-3">
        <div class="border p-2 h-200px">
            <?php appFuncModule::dbForm('comment', $option); ?>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div class="w-200px pt-2">
            <?php appFuncDisp::img("logo_tp.png"); ?>
        </div>
    </div>
</div>