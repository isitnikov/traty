<?php
require APP_TEMPLATES_PATH . 'header.php';

$db = new OperationCollection(); $amounts = $db->getAmountsGroupedBy('month');

$months = array();
$currentDate = time();
$userCreated = GeneralHelper::getDateTime(App::getUser()->getCreated())->format('U');
for ($i = -2; $i<=11; $i++) {
    $date = strtotime("${i} month", $currentDate);
    if ($userCreated > $date) {
        continue;
    }
    $months[date('n', $date)] = GeneralHelper::getDateLabel($date, 'month');
}
$incomeBudget = $amounts[date('n')][Category::TYPE_INCOME]['amount'];
$spendBudget  = $amounts[date('n')][Category::TYPE_SPEND]['amount'];


?>
<div class="container">
    <?php
    $categories = array('Продукты', 'Транспорт', 'Одежда', 'Авто', 'Отдых', 'Еда вне дома', 'Развлечения');
    ?>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-primary">План бюджета
                <small>на месяц</small>
            </h3>
            <div class="table-responsive">
                <table class="table table-condensed">
                    <tr class="active">
                        <th width="160px"><span class="text-success">&nbsp;</span></th>
                        <?php foreach ($months as $monthNum => $month): ?>
                        <th class="text-right"><small><?= $month ?></small></th>
                        <?php endforeach ?>
                    </tr>
                    <tr>
                        <th width="160px"><small>Планировал&nbsp;заработать</small></th>
                        <?php
                        foreach ($months as $monthNum => $month) {
                            $amount = $incomeBudget;
                            $sumIncomeBudget[$month] = $amount;
                            ?>
                            <td class="text-right"><?= GeneralHelper::renderAmount($amount, Category::TYPE_INCOME)?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th width="160px" style="border-top: 0"><small>Заработал</small></th>
                        <?php
                        foreach ($months as $monthNum => $month) {
                            $amount = isset($amounts[$monthNum]) && isset($amounts[$monthNum][Category::TYPE_INCOME])
                                ? $amounts[$monthNum][Category::TYPE_INCOME]['amount'] : 0;
                            $sumIncomeFact[$month] = $amount;
                        ?>
                        <td class="text-right" style="border-top: 0"><?= GeneralHelper::renderAmount($amount, Category::TYPE_INCOME)?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th width="160px"><small>Планировал&nbsp;потратить</small></th>
                        <?php
                        foreach ($months as $monthNum => $month) {
                            $amount = $spendBudget;
                            $sumSpendBudget[$month] = $amount;
                            ?>
                            <td class="text-right"><?= GeneralHelper::renderAmount($amount, Category::TYPE_SPEND)?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th width="160px" style="border-top: 0"><small>Потратил</small></th>
                        <?php
                        foreach ($months as $monthNum => $month) {
                            $amount = isset($amounts[$monthNum]) && isset($amounts[$monthNum][Category::TYPE_SPEND])
                                ? $amounts[$monthNum][Category::TYPE_SPEND]['amount'] : 0;
                            $sumSpendFact[$month] = $amount;
                            ?>
                            <td class="text-right" style="border-top: 0"><?= GeneralHelper::renderAmount($amount, Category::TYPE_SPEND)?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th width="160px"><small>Запланировал&nbsp;итог</small></th>
                        <?php
                        foreach ($months as $monthNum => $month) {
                            $allBudgetSum[] = $incomeBudget - $spendBudget;
                            ?>
                            <td class="text-right"><?= GeneralHelper::renderAmount(array_sum($allBudgetSum))?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th width="160px" style="border-top: 0"><small>Итог</small></th>
                        <?php
                        foreach ($months as $monthNum => $month) {
                            $maxMonth = false;
                            if (array_keys($amounts)) {
                                $monthKeys = array_keys($amounts);
                                $maxMonth = end($monthKeys);
                            }

                            $allFactSum[] = $sumIncomeBudget[$month] - $sumIncomeFact[$month];
                            if ($maxMonth && $maxMonth > $monthNum) {
                                $allFactSum = array();
                            }
                            ?>
                            <td class="text-right" style="border-top: 0"><?= GeneralHelper::renderAmount(array_sum($allFactSum))?></td>
                        <?php } ?>
                    </tr>
                </table>
                </div>




        </div>
        <?php return; ?>
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

