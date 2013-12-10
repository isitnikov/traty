<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<form class="form-horizontal" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend><a href="">Расходы</a></legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Имя</label>
            <div class="col-md-4">
                <input id="field-name" name="name" type="text" placeholder="продукты" class="form-control input-md">
                <span class="help-block">Имя или категория расходов</span>
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Сумма</label>
            <div class="col-md-4">
                <input id="field-amount" name="amount" type="text" placeholder="99.70" class="form-control input-md">
                <span class="help-block">Сумма</span>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button type="submit" id="singlebutton" class="btn btn-success">Сохранить</button>
            </div>
        </div>

    </fieldset>
</form>
</body>
</html>

