<?php
require 'header.php';
?>
<div class="container">
    <div class="panel-group" id="accordion">

        <?php
        $line = 0;
        for ($i = 53; $i >= 1; $i--):
        ?>

        <?php
        $rows = $db->getWeekOperationsGrouped($i);
        if (empty($rows)) continue;

        $line++;
        $fullSum = 0;
        foreach ($rows as $row) {
            $fullSum += $row['amount'];
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>">
                         <?php echo $i ?> неделя <?php if ($line == 1) echo "(текущая)" ?>
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
<!--                    <div class="row">
                    <div class="col-xs-6"><?php echo $row['name'] ?></div>
                    <div class="col-xs-6 text-right"><?php echo $row['amount'] ?> грн.</div>
                    </div>-->
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent?>%; background-color: #FFD273; color: #333">
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
