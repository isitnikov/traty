<!DOCTYPE html>
<html>
<head>
    <title>Money</title>
    <meta charset="utf-8">
    <title>Ratchet template page</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <script src="https://code.jquery.com/jquery.js"></script>

    <!-- Include the compiled Ratchet CSS -->
    <link href="<?= App::getBaseUrl() ?>lib/ratchet-2.0.2/dist/css/ratchet.css" rel="stylesheet">
</head>
<body>

<!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav">
    <a class="icon icon-left-nav pull-left"></a>
    <a class="icon icon-compose pull-right"></a>
    <h1 class="title">Title</h1>
</header>

<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content">
    <?php print $this->render('alerts.php') ?>
    <?php print $this->layout()->content ?>
    <?php print $this->render('profiler.php') ?>
</div>

<nav class="bar bar-tab">
    <?php foreach (GeneralHelper::getMainMenu() as $key => $link): ?>
        <a class="tab-item <?= GeneralHelper::getClassForMenuItem($link) ?>" href="<?= $link['url'] ?>">
            <span class="icon <?= $link['icon'] ?>"></span>
            <span class="tab-label"><?= $link['label'] ?></span>
        </a>
    <?php endforeach ?>
</nav>

</body>
</html>
