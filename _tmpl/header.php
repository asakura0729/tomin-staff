<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo appConfigPage::$title; ?></title>
    <meta name="description" content="<?php echo appConfigPage::$description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="format-detection" content="telephone=no">
    <meta name="htmx-config" content='{"historyCacheSize": 0}'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Noto+Serif+JP:wght@600&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/common.css?<?php echo appConfigSite::update; ?>" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" onload="this.media='all'">
    <?php echo appConfigPage::$css; ?>
    <?php echo appConfigPage::$js; ?>
</head>

<body class="font-notosans">