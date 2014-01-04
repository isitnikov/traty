<?php
$months = array();
$currentDate = time();
$userCreated = GeneralHelper::getDateTime(App::getUser()->getCreated())->format('U');
for ($i = -2; $i <= 7; $i++) {
    $date = strtotime("${i} month", $currentDate);
    if ($userCreated > $date) {
        continue;
    }
    $months[date('n', $date)] = GeneralHelper::getDateLabel($date, 'month');
}
?>
<div class="col-lg-12">
    <h3 class="text-primary">План бюджета
        <small>на месяц</small>
    </h3>
    <div class="table-responsive" style="overflow-x: scroll">
        <table class="table table-condensed">
            <tr class="active">
                <th width="160px"><span class="text-success">&nbsp;</span></th>
                <?php foreach ($months as $monthNum => $month): ?>
                    <th class="text-right">
                        <small><?= $month ?></small>
                    </th>
                <?php endforeach ?>
            </tr>
            <tr>
                <th width="160px">
                    <small>Планировал&nbsp;заработать</small>
                </th>
                <?php
                foreach ($months as $monthNum => $month) {
                    $amount = $this->incomeBudget;
                    $sumIncomeBudget[$month] = $amount;
                    ?>
                    <td class="text-right"><?= GeneralHelper::renderAmount($amount, Category::TYPE_INCOME) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th width="160px" style="border-top: 0">
                    <small>Заработал</small>
                </th>
                <?php
                foreach ($months as $monthNum => $month) {
                    $amount = isset($this->amounts[$monthNum]) && isset($this->amounts[$monthNum][Category::TYPE_INCOME])
                        ? $this->amounts[$monthNum][Category::TYPE_INCOME]['amount'] : 0;
                    $sumIncomeFact[$month] = $amount;
                    ?>
                    <td class="text-right"
                        style="border-top: 0"><?= GeneralHelper::renderAmount($amount, Category::TYPE_INCOME) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th width="160px">
                    <small>Планировал&nbsp;потратить</small>
                </th>
                <?php
                foreach ($months as $monthNum => $month) {
                    $amount = $this->spendBudget;
                    $sumSpendBudget[$month] = $amount;
                    ?>
                    <td class="text-right"><?= GeneralHelper::renderAmount($amount, Category::TYPE_SPEND) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th width="160px" style="border-top: 0">
                    <small>Потратил</small>
                </th>
                <?php
                foreach ($months as $monthNum => $month) {
                    $amount = isset($this->amounts[$monthNum]) && isset($this->amounts[$monthNum][Category::TYPE_SPEND])
                        ? $this->amounts[$monthNum][Category::TYPE_SPEND]['amount'] : 0;
                    $sumSpendFact[$month] = $amount;
                    ?>
                    <td class="text-right"
                        style="border-top: 0"><?= GeneralHelper::renderAmount($amount, Category::TYPE_SPEND) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th width="160px">
                    <small>Запланировал&nbsp;итог</small>
                </th>
                <?php
                foreach ($months as $monthNum => $month) {
                    $allBudgetSum[] = $this->incomeBudget - $this->spendBudget;
                    ?>
                    <td class="text-right"><?= GeneralHelper::renderAmount(array_sum($allBudgetSum)) ?></td>
                <?php } ?>
            </tr>
            <tr>
                <th width="160px" style="border-top: 0">
                    <small>Итог</small>
                </th>
                <?php
                foreach ($months as $monthNum => $month) {
                    $maxMonth = false;
                    if (array_keys($this->amounts)) {
                        $monthKeys = array_keys($this->amounts);
                        $maxMonth = end($monthKeys);
                    }

                    $allFactSum[] = $sumIncomeFact[$month] - $sumSpendFact[$month];
                    if ($maxMonth && $maxMonth > $monthNum) {
                        $allFactSum = array();
                    }
                    ?>
                    <td class="text-right"
                        style="border-top: 0"><?= GeneralHelper::renderAmount(array_sum($allFactSum)) ?></td>
                <?php } ?>
            </tr>
        </table>
    </div>
</div>
