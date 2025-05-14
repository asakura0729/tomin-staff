<?php
//======================================================================
//検索フォーム専用JS
//======================================================================
?>
<?php appFuncModule::js('form-cs', ['target' => appConfigSite::secSearch]); ?>
<?php appFuncModule::js('form-submit-download', ['target' => appConfigSite::secSearch]); ?>
<?php appFuncModule::js('pageload-submit', ['target' => '[data-submit-search]']); ?>
<?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) != true): ?>
    <?php /*分岐：スタッフ権限*/ ?>
    <?php appFuncModule::js('form-user_id', ['target' => appConfigSite::secSearch, 'child' => 'select[name=post_by]']); ?>
    <?php appFuncModule::js('form-readonly', ['target' => appConfigSite::secSearch, 'child' => 'select[name=post_by]']); ?>
<?php endif; ?>