<?php
require APP_TEMPLATES_PATH . 'header.php';

$months = array();
$currentDate = time();
$months[] = GeneralHelper::getDateLabel(strtotime("-2 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("-1 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel($currentDate, 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+1 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+2 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+3 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+4 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+5 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+6 month", $currentDate), 'month');
$months[] = GeneralHelper::getDateLabel(strtotime("+7 month", $currentDate), 'month');



?>
<div class="container">
    <?php
    $categories = array('Продукты', 'Транспорт', 'Одежда', 'Авто', 'Отдых', 'Еда вне дома', 'Развлечения');
    ?>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-primary">Бюджет
                <small>на месяц</small>
            </h3>
            <div class="table-responsive">
                <table class="table">
                    <tr class="active">
                        <th><span class="text-danger">Расходы</span></th>
                        <?php foreach ($months as $month): ?>
                        <th class="text-right"><small><?= $month ?></small></th>
                        <?php endforeach ?>
                    </tr>
                    <tr>
                        <th><small>Бюджет</small></th>
                        <?php foreach ($months as $month): ?>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <?php endforeach ?>
                    </tr>
                    <tr>
                        <th style="border-top: 0"><small>Фактически</small></th>
                        <?php foreach ($months as $month): ?>
                        <td class="text-right" style="border-top: 0"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <?php endforeach ?>
                    </tr>
                    <tr>
                        <th>Итого: </th>
                        <?php foreach ($months as $month): ?>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <?php endforeach ?>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-xs-12">
            <h3 class="text-primary">Задать бюджет
                <small>на месяц</small>
            </h3>
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Расходы в среднем</th>
                    <th class="text-right">Бюджет</th>
                </tr>

                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category ?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND) ?></td>
                        <td class="text-right" width="30%"><input type="text" name="amount" placeholder="00.00"
                                                                  class="form-control"/></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>

