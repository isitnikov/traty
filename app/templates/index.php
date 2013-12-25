<?php
require 'header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form role="form" method="post" action="<?php echo GeneralHelper::getUrl('operation', 'save') ?>"
                  id="login">
                <fieldset>
                    <!-- Form Name -->
                    <legend class="sr-only">Расходы</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label sr-only" for="category">Категория</label>
                        <select id="category" name="category" class="form-control input-lg" >
                            <optgroup label="Расходы">
                                <?php foreach ($spendCategories as $value => $label): ?>
                                    <option value="<?= $value ?>"><?= $label ?></option>
                                <?php endforeach ?>
                            </optgroup>
                            <optgroup label="Доходы">
                                <?php foreach ($incomeCategories as $value => $label): ?>
                                    <option value="<?= $value ?>"><?= $label ?></option>
                                <?php endforeach ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label sr-only" for="textinput">Сумма</label>

                                <input id="field-amount" name="amount" type="text" placeholder="Сумма"
                                       pattern="[0-9]+[.,]?[0-9]*"
                                       class="form-control input-lg">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label sr-only" for="textinput">Дата</label>

                                <?php $dateValue = date('d/m/Y') ?>
                                <input id="field-date" name="date" type="text"
                                       placeholder="<?php echo $dateValue ?>"
                                       class="form-control input-lg" value="<?php echo $dateValue ?>">
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="control-label" for="singlebutton"></label>

                        <button type="submit" id="singlebutton" class="btn btn-success btn-block btn-lg">Сохранить
                        </button>
                    </div>

                </fieldset>
            </form>


        </div>

        <?php
        $amountSumIncome = array();
        $amountSumSpend  = array();
        ?>
        <div class="col-md-6">
            <table class="table">
                <caption class="text-left">Операции за сегодня</caption>
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Сумма</th>
                </tr>
                <?php foreach ($todayIncomeOperations as $operation): ?>
                    <?php $amountSumIncome[] = $operation->getAmount(); ?>
                    <tr class="success">
                        <td>
                            <a href="<?php echo BASE_URL . '?controller=operation&action=delete&operation_id=' . $operation->getId() ?>"
                               onclick="return confirm('Удалить операцию?')" class="glyphicon glyphicon-trash"></a>

                            <?php echo $operation->categoryObject()->getName() ?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount($operation->getAmount(), Category::TYPE_INCOME) ?></td>
                    </tr>
                <?php endforeach ?>
                <?php foreach ($todaySpendOperations as $operation): ?>
                    <?php $amountSumSpend[] = $operation->getAmount() ?>
                    <tr>
                        <td>
                            <a href="<?php echo BASE_URL . '?controller=operation&action=delete&operation_id=' . $operation->getId() ?>"
                               onclick="return confirm('Удалить операцию?')" class="glyphicon glyphicon-trash"></a>

                            <?php echo $operation->categoryObject()->getName() ?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount($operation->getAmount(), Category::TYPE_SPEND) ?></td>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr class="">
                    <td colspan="2">
                        <?php if ($amountSumIncome): ?>
                        <p class="text-success"><strong>Доход за день: <?= GeneralHelper::renderAmount(array_sum($amountSumIncome), Category::TYPE_INCOME) ?></strong></p>
                        <?php endif ?>
                        <?php if ($amountSumSpend): ?>
                        <p class="text-danger"><strong>Расход за день: <?= GeneralHelper::renderAmount(array_sum($amountSumSpend), Category::TYPE_SPEND) ?></strong></p>
                        <?php endif ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>

