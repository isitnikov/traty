<!DOCTYPE html>
<html>
<head>
    <title>Money</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <!-- iOS Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-152x152.png"/>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<header class="navbar navbar-default" role="navigation">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php
            $brandName = 'Spend.su';
            if (isset($todayAmount)) {
                $brandName = "За сегодня: " . GeneralHelper::getTodayAmount() . " " . GeneralHelper::getCurrencySign();
            }
        ?>
        <a class="navbar-brand" href="<?php echo BASE_URL ?>"><?= $brandName ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
        <ul class="nav navbar-nav">
            <?php
                $links = array(
                    array('url' => App::getBaseUrl(), 'label' => 'Главная'),
                    array('url' => GeneralHelper::getUrl('report', 'view'), 'label' => 'Отчеты'),
                );
            ?>

            <?php foreach ($links as $key => $link): ?>
                <?php
                    $active = '';
                    if ($link['url'] == GeneralHelper::getUrl(App::getRequest('controller'), App::getRequest('action'))
                    || ($key == 0 && App::getRequest('controller') == false)) {
                        $active = 'active';
                    }

                ?>
                <li class="<?= $active ?>"><a href="<?= $link['url'] ?>"><?= $link['label'] ?></a></li>
            <?php endforeach ?>
            <?php
            $links = array(
                array('url' => GeneralHelper::getUrl('category', 'view'), 'label' => 'Категории'),
                array('url' => GeneralHelper::getUrl('family', 'view'), 'label' => 'Мой профайл'),
                array(),
                array('url' => GeneralHelper::getUrl('user', 'logout'), 'label' => 'Выйти')
            );
            ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Настройки<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php foreach ($links as $key => $link): ?>
                        <?php
                        $active = '';
                        if (!empty($link) && $link['url'] == GeneralHelper::getUrl(App::getRequest('controller'), App::getRequest('action'))) {
                            $active = 'active';
                        }

                        ?>
                        <?php if (!empty($link)) { ?>
                        <li class="<?= $active ?>"><a href="<?= $link['url'] ?>"><?= $link['label'] ?></a></li>
                        <?php } else { ?>
                            <li class="divider"></li>
                        <?php } ?>
                    <?php endforeach ?>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
</header>
<div class="container">
    <?php $alerts = App::popAlerts(); ?>
    <?php foreach ($alerts as $key => $alert): ?>
    <?php
        $class = 'alert-success';
        if ($key == 'error') {
            $class = 'alert-danger';
        }
     ?>
        <div class="alert <?= $class ?> fade in">
            <?= $alert ?>
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <script>
                window.setTimeout(function() { $('div.alert-success').alert('close'); }, 2000)
            </script>
        </div>
    <?php endforeach ?>
</div>
