<?php
require 'header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">

            <ul class="nav nav-pills">
                <li class="active"><a href="#spend" class="glyphicon glyphicon-minus" data-toggle="tab"> Расходы</a></li>
                <li><a href="#income" class="glyphicon glyphicon-plus" data-toggle="tab"> Доходы</a></li>
            </ul>
            <div class="row">&nbsp;</div>

            <div class="tab-content">
                <div class="tab-pane active" id="spend">
                    <form role="form" method="post" action="<?php echo GeneralHelper::getUrl('operation', 'save') ?>" id="login">
                        <fieldset>
                            <input type="hidden" name="type" value="1" />

                            <!-- Form Name -->
                            <legend class="sr-only">Расходы</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label sr-only" for="category">Категория</label>
                                <select id="category" name="category" class="form-control input-lg">
                                    <?php foreach ($spendCategories as $value => $label): ?>
                                        <option value="<?= $value ?>"><?= $label ?></option>
                                    <?php endforeach ?>
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



                <div class="tab-pane" id="income">
                    <form role="form" method="post" action="<?php echo GeneralHelper::getUrl('operation', 'save') ?>" id="login">
                        <fieldset>
                            <input type="hidden" name="type" value="2" />
                            <!-- Form Name -->
                            <legend class="sr-only">Расходы</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label sr-only" for="category">Категория</label>

                                <select id="category" name="category" class="form-control input-lg">
                                    <?php foreach ($incomeCategories as $value => $label): ?>
                                        <option value="<?= $value ?>"><?= $label ?></option>
                                    <?php endforeach ?>
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
            </div>





        </div>

        <div class="col-md-6">
            <table class="table">
                <caption class="text-left">Операции за сегодня</caption>
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Сумма</th>
                </tr>
                <?php foreach ($todayOperations as $operation): ?>
                    <tr>
                        <td>
                            <a href="<?php echo BASE_URL . '?controller=operation&action=delete&operation_id=' . $operation->getId() ?>"
                               onclick="return confirm('Удалить операцию?')" class="glyphicon glyphicon-trash"></a>

                            <?php echo $operation->categoryObject()->getName() ?></td>
                        <td class="text-right"><?php echo $operation->getAmount() ?> <span class="currency"></span> грн.</td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

