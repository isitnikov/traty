<div class="row">
    <div class="col-xs-12">
        <h3 class="text-primary">Задать бюджет
            <small class="dropdown">
                <a href="#" data-toggle="dropdown">на <?= $this->currentMonthLabel ?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <?php foreach ($this->months as $month): ?>
                    <li><a href="<?= GeneralHelper::getUrl('budget', 'view', array('date' => GeneralHelper::getDateValue($month, 'date'))) ?>"><?= GeneralHelper::getDateLabel($month, 'month')?></a></li>
                    <?php endforeach ?>
                </ul>
            </small>
        </h3>
        <form role="form" method="post" action="<?= GeneralHelper::getUrl('budget', 'save') ?>">
            <input type="hidden" name="date" value="<?= App::getRequest('date', date('Y-m-d')) ?>" />
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th>В прошлом месяце</th>
                    <th class="text-right">Бюджет</th>
                </tr>

                <?php foreach ($this->categories as $category): ?>
                    <tr>
                        <td>
                            <?= $category->getName() ?>
                        </td>
                        <td>
                            <?php
                            $prevMonthAmount = isset($this->categoryAmounts[$category->getId()]) ? $this->categoryAmounts[$category->getId()]['amount'] : 00.00;

                            ?>
                            <?= GeneralHelper::renderAmount($prevMonthAmount, $category->getType()) ?>
                        </td>
                        <td class="text-right" width="30%">
                            <?php
                            $_budgetValue = isset($this->budgetArray[$category->getId()]) ? $this->budgetArray[$category->getId()]->getAmount() : 00.00;
                            ?>
                            <input type="text" name="budget[<?= $category->getId() ?>]" value="<?= $_budgetValue ?>" placeholder="00.00" class="form-control text-right" />
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            <input type="submit" class="btn btn-success pull-right" value="Сохранить"/>
        </form>
    </div>
</div>

