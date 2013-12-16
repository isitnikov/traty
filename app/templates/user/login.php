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
<style>
    body {
        background: url(http://farm4.staticflickr.com/3803/11381218425_b27403785d_b.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .panel-default {
        opacity: 0.9;
        margin-top:30px;
    }
    .form-group.last { margin-bottom:0px; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-7">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding-bottom: 0px">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" style="border-bottom: 0px">
                        <?php
                            $loginTab = 'active';
                            $regTab = '';
                            if (App::getRequest('registration-tab')) {
                                $loginTab = '';
                                $regTab = 'active';
                            }
                        ?>
                        <li class="<?= $loginTab ?>"><a href="#login" data-toggle="tab">Войти на сайт</a></li>
                        <li class="<?= $regTab ?>"><a href="#registration" data-toggle="tab">Регистрация</a></li>
                    </ul>
                </div>
                <div class="panel-body">

                    <?php if (App::getRequest('message')): ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Ошибка: </strong> <?= urldecode(App::getRequest('message')) ?>
                    </div>
                    <?php endif ?>







                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="login">


                            <form class="form-horizontal" role="form" method="post" action="<?= GeneralHelper::getUrl('user', 'auth') ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">
                                        Пользователь</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" class="form-control input-lg" id="inputEmail3" placeholder="username" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">
                                        Пароль</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control input-lg" id="inputPassword3" placeholder="******" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="rememberme" value="1"/>
                                                Запомнить меня
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            Войти</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                        <div class="tab-pane" id="registration">


                            <form class="form-horizontal" role="form" method="post" action="<?= GeneralHelper::getUrl('user', 'registration') ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">
                                        Пользователь</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" class="form-control input-lg" id="inputEmail3" placeholder="username" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">
                                        Пароль</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control input-lg" id="inputPassword3" placeholder="******" required>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            Регистрация</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>





                </div>
                <div class="panel-footer">
                    <a href="http://www.jquery2dotnet.com">Регистрация</a></div>
            </div>
        </div>
    </div>
</div>