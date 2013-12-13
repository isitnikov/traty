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
    <div class="panel-group" id="accordion">

        <?php for ($i = 53; $i >= 1; $i--): ?>

        <?php
        $rows = $db->getWeekOperationsGrouped($i);
        if (empty($rows)) continue;

        $fullSum = 0;
        foreach ($rows as $row) {
            $fullSum += $row['amount'];
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>">
                         <?php echo $i ?> неделя (текущая)
                    </a>
                    <div class="pull-right"><?php echo $fullSum ?> <?php echo GeneralHelper::getCurrencySign() ?></div>
                </h4>
            </div>
            <div id="collapse<?php echo $i ?>" class="panel-collapse collapse">
                <div class="panel-body">


                    <?php foreach ($rows as $row): ?>
                    <?php
                        $amount = $row['amount'];
                        $percent = $amount * 100 / $fullSum;
                    ?>
                        <span class=""><?php echo $row['name'] ?></span>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent?>%;">
                            <span class=""><?php echo $row['name'] ?></span>
                        </div>
                        <div class="text-right"><?php echo $row['amount'] ?> грн.</div>
                    </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
        <?php endfor ?>

    </div>
</div>
</body>
</html>
