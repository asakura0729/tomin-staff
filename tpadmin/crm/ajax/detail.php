<?php require_once '../../../_app/http/tpadmin/crm/ajax/detail.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .l-submit {
        position: fixed;
        bottom: 0;
        right: 100px;
        width: 400px;
        z-index: 2000;
        border-radius: .25rem;
    }

    .l-submit-inner {
        height: 60px;
        border: 3px solid #fff;
    }

    .ql-container {
        height: 200px;
    }
</style>

<form id="form" action="<?php echo appConfigSite::sitemap['adminCrmConfirm']['path']; ?>" method="post" class="row no-gutters pb-5">
    <div class="col-12 col-lg-3">
        <section id="sec-1" class="pb-4">
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '故人情報', ['class' => 'text-center']); ?>
                <?php appLibraryDisp::dbform('hidden', ['funeral_id'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名']); ?>
                <div class="form-row pb-2">
                    <?php appLibraryDisp::dbform('text_row', ['decd_lname', 'decd_fname'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
                <?php appLibraryDisp::globalModule('form/label', ['title' => '氏名(カナ)']); ?>
                <div class="form-row pb-2">
                    <?php appLibraryDisp::dbform('text_row', ['decd_lname_kana', 'decd_fname_kana'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
                <?php appLibraryDisp::dbform('select_label', ['decd_gender'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigStatus::gender]); ?>
                <?php appLibraryDisp::dbform('text_label', ['decd_region'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
            </div>
        </section>
        <section id="sec-2" class="pb-4 position-relative">
            <div class="pos-top-right p-2">
                <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-add data-hx-get="/tpadmin/crm/ajax/client" data-hx-target="#sec-2-1" hx-swap="afterbegin"']); ?>
            </div>
            <div class="bg-white">
                <?php appLibraryDisp::heading('h2', '依頼者情報', ['class' => 'text-center m-0 p-3']); ?>
                <div id="sec-2-1" class="bg-llgray p-2 pb-4 border-top"><?php appLibraryDisp::globalModule('comp/nodata', ['title' => '依頼者情報未登録']); ?></div>
            </div>
        </section>
    </div>
    <div class="col-12 col-lg-5 pl-lg-3 pr-lg-3">
        <section id="sec-3" class="pb-4">
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '過去対応ログ', ['class' => 'text-center']); ?>
                <div class="border h-300px overflow-y bg-llgray">
                    <table class="table table-bordered table-sm bg-white">
                        <thead class="bg-contrast-l text-center">
                            <tr>
                                <th class="w-25per" scope="col">日時</th>
                                <th class="w-25per" scope="col">状況</th>
                                <th class="w-25per" scope="col">カテゴリ</th>
                                <th class="w-25per" scope="col">作成日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center p-3">データが存在しません</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row pt-3">
                    <div class="col-12 col-lg-6">
                        <?php appLibraryDisp::dbform('select_label', ['plan'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigFuneral::plan]); ?>
                        <?php appLibraryDisp::dbform('select_label', ['ensconce'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral, ['selectItem' => appConfigFuneral::enshrined]); ?>
                    </div>
                    <div class="col-12 col-lg-6">
                        <?php appLibraryDisp::dbform('date', ['funeral_date'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                    </div>
                    <div class="col-12 pb-2">
                        <?php appLibraryDisp::dbform('text_label', ['ensconce_address'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                        <?php appLibraryDisp::dbform('text_label', ['dest_name'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                        <?php appLibraryDisp::dbform('text_label', ['dest_address'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                        <div class="w-150px d-flex"><?php appLibraryDisp::dbform('text_label', ['totalpeople'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?></div>
                    </div>
                    <div class="col-12">
                        <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-1', 'table' => appDatabaseFuneral::table['crematory']]); ?>
                        <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-2', 'table' => appDatabaseFuneral::table['hall']]); ?>
                        <?php appLibraryDisp::module('../_module/form_add.php', ['id' => 'sec-3-3', 'table' => appDatabaseFuneral::table['option']]); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-12 col-lg-4">
        <section id="sec-4" class="pb-4 position-relative">
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '本日対応ログ', ['class' => 'text-center']); ?>
                <div class="l-textarea">
                    <div data-editor="comment"></div>

                    <?php appLibraryDisp::dbform('hidden',  ['comment'], appDatabaseReport::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
            </div>
        </section>
        <section id="sec-5" class="pb-4 position-relative">
            <div class="p-3 bg-white">
                <?php appLibraryDisp::heading('h2', '申し送り事項', ['class' => 'text-center']); ?>
                <div class="l-textarea">
                    <div data-editor="funeral_comment"></div>
                    <?php appLibraryDisp::dbform('hidden',  ['funeral_comment'], appDatabaseFuneral::table, appHttpTpAdminCrmAjaxDetail::$resultFuneral); ?>
                </div>
            </div>
        </section>
        <section id="sec-6" class="pb-4 position-relative">
            <div class="pos-top-right p-2 pr-3">
                <?php appLibraryDisp::globalModule('form/btn_add', ['add' => 'data-add data-hx-get="/tpadmin/crm/ajax/report_tel" data-hx-target="#sec-6-1" hx-swap="afterbegin"']); ?>
            </div>
            <div class="bg-white">
                <?php appLibraryDisp::heading('h2', '架電日時登録', ['class' => 'text-center m-0 p-3']); ?>
                <div id="sec-6-1" class="bg-llgray p-3 pb-4 border-top"><?php appLibraryDisp::globalModule('comp/nodata', ['title' => '架電日時未登録']); ?></div>
            </div>
        </section>
    </div>

    <div class="l-submit p-5">
        <?php appLibraryDisp::globalModule('form/hidden_posttype', ['id' => appHttpTpAdminCrmAjaxDetail::$resultFuneral[appDatabaseFuneral::primaryKey]]); ?>
        <div class="l-submit-inner">
            <?php appLibraryDisp::globalModule('form/btn_submit', ['add' => 'data-submit', 'title' => '登録する']); ?>
        </div>
    </div>

</form>

<script>
    htmx.onLoad(function(content) {
        const form = document.getElementById('form');
        if (form) {
            form.addEventListener('click', function(event) {
                if (event.target.closest('[data-submit]')) {
                    form.submit();
                }
            });
            form.querySelectorAll('[data-add]').forEach(button => {
                button.addEventListener('click', function() {
                    const hxTarget = this.getAttribute("data-hx-target");
                    const target = document.querySelector(hxTarget);
                    if (target.querySelectorAll('input').length <= 0) {
                        target.innerHTML = '';
                    }
                });
            });
        }
    });
    if (typeof WYSIWYG === 'undefined') {
        const WYSIWYG = function() {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js';
            document.head.appendChild(script);
            setTimeout(() => {
                const sec4editor = new Quill('[data-editor="comment"]', {
                    theme: 'snow'
                });
                const sec5editor = new Quill('[data-editor="funeral_comment"]', {
                    theme: 'snow'
                });
            }, "500");
        }
        WYSIWYG();
    }
</script>