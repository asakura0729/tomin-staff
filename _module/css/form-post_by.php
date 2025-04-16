<?php
//======================================================================
// 受電者入力フォームの制御（マスター権限以外は、自身しか選択不可）
//======================================================================
?>
<?php if (appFuncSession::checkAuth(appConfigUser::authorityManager) === false): ?>
    <style>
        <?php echo $option['target'] . ' '; ?>select[name="<?php echo appDatabaseCs::table['post_by']['name']; ?>"] {
            background: #eee;
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
<?php endif; ?>