<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if (appConfigPage::$tmpl == "home" || appConfigPage::$tmpl == "custom") : ?>
        <title><?php echo appConfigPage::$title; ?></title>
    <?php else : ?>
        <title><?php echo appConfigPage::$title; ?>｜<?php echo appConfigSite::siteName; ?></title>
    <?php endif; ?>

    <meta name="description" content="<?php echo appConfigPage::$description; ?>">
    <?php if (appConfigPage::$tmpl != "photo") : ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php endif; ?>
    <meta name="format-detection" content="telephone=no">
    <meta name="htmx-config" content='{"historyCacheSize": 0}'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Noto+Serif+JP:wght@600&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/common.css?202502" rel="stylesheet" />
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" onload="this.media='all'" />
    <?php echo appConfigPage::$css; ?>
    <script src="/assets/js/htmx.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="font-notosans">