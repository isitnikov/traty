<?php
require APP_TEMPLATES_PATH . 'header.php';


$months = array();
$currentDate = time();
$userCreated = GeneralHelper::getDateTime(App::getUser()->getCreated())->format('U');
for ($i = -2; $i<=7; $i++) {
    $date = strtotime("${i} month", $currentDate);
    if ($userCreated > $date) {
        continue;
    }
    $months[date('n', $date)] = GeneralHelper::getDateLabel($date, 'month');
}


?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
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

                            $allFactSum[] = $sumIncomeFact[$month] - $sumSpendFact[$month];
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
        <div class="col-xs-12">&nbsp;</div>
        <div class="col-xs-12">
            <h3 class="text-primary">Задать бюджет
                <small>на месяц</small>
            </h3>
            <form role="form" method="post" action="<?= GeneralHelper::getUrl('budget', 'save') ?>">
            <input type="text" name="date" class="form-control" placeholder="2014-01-01" />
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Бюджет</th>
                </tr>

                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category->getName() ?>
                            <!--<nobr class="small text-muted"><small>В прошлом месяце <?= GeneralHelper::renderAmount(rand(100, 1000)) ?></small></nobr>-->
                        </td>
                        <td class="text-right" width="30%">
                            <?php
                            $_budgetValue =  isset($budgetArray[$category->getId()])? $budgetArray[$category->getId()]->getAmount() : 00.00;
                            ?>
                            <input type="text" name="budget[<?= $category->getId() ?>]" placeholder="00.00" class="form-control" value="<?= $_budgetValue ?>"/>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
                <input type="submit" class="btn btn-success pull-right" value="Сохранить" />
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>

