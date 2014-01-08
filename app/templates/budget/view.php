<div class="row">

    <?php if (App::getRequest('mode') == 'edit'): ?>
    <div class="col-xs-12">
        <form role="form" method="post" action="<?= GeneralHelper::getUrl('budget', 'save') ?>">
            <input type="hidden" name="date" value="<?= App::getRequest('date', date('Y-m-d')) ?>" />
            <div class="form-group">
                <input type="hidden" name="category" class="form-control" id="exampleInputEmail1" value="<?= App::getRequest('category')?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Бюджет для <span class="text-success"><?= $this->categories[App::getRequest('category')]->getName() ?></span></label>
                <input type="text" name="amount" class="form-control" id="exampleInputPassword1" placeholder="00.00" value="<?= App::getRequest('amount')?>">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
    <?php endif ?>

    <div class="col-xs-12">
        <h3 class="text-primary">Бюджет
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
            <div class="table-responsive">
            <table class="table table-condensed">
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Факт</th>
                    <th class="text-right">План</th>
                </tr>

                <?php foreach ($this->categories as $category): ?>
                    <tr>
                        <td>
                            <?= $category->getName() ?>
                        </td>
                        <td class="text-right">
                            <?php
                            $prevMonthAmount = isset($this->categoryAmounts[$category->getId()]) ? $this->categoryAmounts[$category->getId()]['amount'] : 00.00;
                            ?>
                            <div class=""><nobr class="text-muted"><?= GeneralHelper::renderAmount($prevMonthAmount, $category->getType()) ?></nobr></div>
                        </td>
                        <td class="text-right" width="30%">
                            <?php
                            $_budgetValue = isset($this->budgetArray[$category->getId()]) ? $this->budgetArray[$category->getId()]->getAmount() : 00.00;
                            ?>
                            <nobr>
                                <?= GeneralHelper::renderAmount($_budgetValue, $category->getType()) ?>
                                <a href="<?= GeneralHelper::getUrl('budget', 'view', array('mode' => 'edit', 'category' => $category->getId(), 'amount' => $_budgetValue, 'date' => $this->date)) ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </nobr>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
            </div>
            <input type="submit" class="btn btn-success pull-right" value="Сохранить"/>
        </form>
    </div>
</div>

