<?php
require 'header.php';
$navDateClass = $reportType == 'date' || !$reportType ? 'active' : '';
$navWeekClass = $reportType == 'week' ? 'active' : '';
$navMonthClass = $reportType == 'month' ? 'active' : '';
$operations = $db->getAmountsGroupedBy($reportType);
?>
<div class="container">

    <ul class="nav nav-pills">
        <li class="<?= $navDateClass ?>"><a href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=date' ?>">Дни</a></li>
        <li class="<?= $navWeekClass ?>"><a href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=week' ?>">Недели</a></li>
        <li class="<?= $navMonthClass ?>"><a href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=month' ?>">Месяца</a></li>
    </ul>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <caption class="text-left">Отчет по дням</caption>
                <tr>
                    <th>День</th>
                    <th class="text-right">Сумма</th>
                </tr>
                <?php foreach ($operations as $operation): ?>
                <tr>
                    <td><a href="<?= App::getBaseUrl() . '?controller=report&action=detail&report_type=' . $reportType . '&date=' . $operation['date'] ?>"><?= GeneralHelper::getDateLabel($operation['date'], $reportType) ?></a></td>
                    <td class="text-right"><?= $operation['amount'] ?> <?= GeneralHelper::getCurrencySign() ?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
