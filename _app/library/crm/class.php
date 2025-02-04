<?php
require __DIR__ . '/trait/get.php';
require __DIR__ . '/trait/post.php';
//======================================================================
// CRM
//======================================================================
class appLibraryCrm
{
    use appLibraryCrmGet;
    use appLibraryCrmPost;
    //-----------------------------------------------------
    // 使用するパラメータ
    //-----------------------------------------------------
    const postConfirm = 'confirm';
    const confirmFuneralId = 'funeral_id';
    const confirmFuneralData = 'funeral';
    const confirmFuneralClientData = 'funeral_client';
    const confirmContainerCs = 'conainer_cs';
    const confirmReport = 'report';
    const debug = false;
}
