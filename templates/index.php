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
<div class="container">
        <form class="form-horizontal" method="post">
            <fieldset>

                <!-- Form Name -->
                <legend><a href="">За сегодня: <?php echo $todayAmount ?> грн</a></legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="category">Категория</label>

                    <div class="col-md-5">
                        <select id="category" name="name" class="form-control input-lg">
                            <option value="Транспорт">Транспорт</option>
                            <option value="Продукты">Продукты</option>
                            <option value="Одежда, косметика">Одежда, косметика</option>
                            <option value="Отдых">Отдых</option>
                            <option value="Медицина">Медицина</option>
                            <option value="Авто">Авто</option>
                            <option value="Жилье">Жилье</option>
                            <option value="Еда вне дома">Еда вне дома</option>
                            <option value="Обучение">Обучение</option>
                            <option value="Работа">Работа</option>
                            <option value="Спорт">Спорт</option>
                            <option value="Разное">Разное</option>
                            <option value="Домашние животные">Домашние животные</option>
                            <option value="Долги, кредиты">Долги, кредиты</option>
                            <option value="Накопления">Накопления</option>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Сумма</label>

                            <div class="col-md-4">
                                <input id="field-amount" name="amount" type="text" placeholder="99.70" pattern="[0-9]+[.,]?[0-9]*"
                                       class="form-control input-lg">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Дата</label>

                            <div class="col-md-4">
                                <?php $dateValue = date('d/m/Y') ?>
                                <input id="field-date" name="date" type="text" placeholder="<?php echo $dateValue ?>"
                                       class="form-control input-lg" value="<?php echo $dateValue ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>

                    <div class="col-md-4">
                        <button type="submit" id="singlebutton" class="btn btn-success btn-block btn-lg">Сохранить
                        </button>
                    </div>
                </div>

            </fieldset>
        </form>

        <table class="table">
            <caption>Операции за сегодня</caption>
            <tr>
                <th>Категория</th>
                <th>Сумма</th>
                <th></th>
            </tr>

            <tr>
                <td>Продукты</td>
                <td>10</td>
                <td><a href=""><span class="glyphicon glyphicon-remove-circle"></span> Удалить</a></td>
            </tr>
            <tr>
                <td>Продукты</td>
                <td>10</td>
                <td><a href=""><span class="glyphicon glyphicon-remove-circle"></span> Удалить</a></td>
            </tr>
        </table>
</div>
</body>
</html>

