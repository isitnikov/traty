<?php
require 'header.php';
$navDateClass = $reportType == 'date' || !$reportType ? 'active' : '';
$navWeekClass = $reportType == 'week' ? 'active' : '';
$navMonthClass = $reportType == 'month' ? 'active' : '';
$operations = $db->getAmountsGroupedBy($reportType);
?>
<div class="container">

    <ul class="nav nav-pills">
        <li class="<?= $navDateClass ?>"><a
                href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=date' ?>">Дни</a></li>
        <li class="<?= $navWeekClass ?>"><a
                href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=week' ?>">Недели</a></li>
        <li class="<?= $navMonthClass ?>"><a
                href="<?= App::getBaseUrl() . '?controller=report&action=view&report_type=month' ?>">Месяца</a></li>
    </ul>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <tr>
                    <th>Дата</th>
                    <th class="text-right">Доход / Расход</th>
                </tr>
                <?php foreach ($operations as $date => $operationsByTypes): ?>
                    <tr>
                        <?php $fullDate = isset($operationsByTypes[Category::TYPE_INCOME])
                            ? $operationsByTypes[Category::TYPE_INCOME]['date'] : $operationsByTypes[Category::TYPE_SPEND]['date']; ?>
                        <td>
                            <a href="<?= GeneralHelper::getUrl('report', 'detail', array('report_type' => $reportType, 'date' => $fullDate)) ?>">
                                <?= GeneralHelper::getDateLabel($fullDate, $reportType) ?>
                            </a>
                        </td>
                        <td class="text-right">
                            <?php $itog = array() ?>
                            <?php foreach ($operationsByTypes as $type => $operation): ?>
                            <?php $itog[$operation['type']][] = $operation['amount'] ?>
                            <?= GeneralHelper::renderAmount($operation['amount'], $operation['type'])?><br/>
                            <?php endforeach ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
