<?php
$navDateClass = $this->reportType == 'date' || !$this->reportType ? 'active' : '';
$navWeekClass = $this->reportType == 'week' ? 'active' : '';
$navMonthClass = $this->reportType == 'month' ? 'active' : '';
$operations = $this->operations;
?>
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
                            <a href="<?= GeneralHelper::getUrl('report', 'detail', array('report_type' => $this->reportType, 'date' => $fullDate)) ?>">
                                <?= GeneralHelper::getDateLabel($fullDate, $this->reportType) ?>
                            </a>
                        </td>
                        <td class="text-right">
                            <?php foreach ($operationsByTypes as $type => $operation): ?>
                            <?= GeneralHelper::renderAmount($operation['amount'], $operation['type'])?><br/>
                            <?php endforeach ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
