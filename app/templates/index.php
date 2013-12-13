<?php
require 'header.php';
?>
<div class="container">
    <form class="form-horizontal" method="post" action="<?php echo BASE_URL . '?controller=operation&action=save' ?>">
        <fieldset>

            <!-- Form Name -->
            <legend class="sr-only">Расходы</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="category">Категория</label>

                <div class="col-md-5">
                    <select id="category" name="name" class="form-control input-lg">
                        <option value="Транспорт">Транспорт</option>
                        <option value="Продукты">Продукты</option>
                        <option value="Одежда, косметика">Одежда, косметика</option>
                        <option value="Отдых">Отдых</option>
                        <option value="Медицина">Медицина</option>
                        <option value="Авто">Авто</option>
                        <option value="Жилье">Жилье</option>
                        <option value="Еда вне дома">Еда вне дома</option>
                        <option value="Обучение">Обучение</option>
                        <option value="Работа">Работа</option>
                        <option value="Спорт">Спорт</option>
                        <option value="Разное">Разное</option>
                        <option value="Домашние животные">Домашние животные</option>
                        <option value="Долги, кредиты">Долги, кредиты</option>
                        <option value="Накопления">Накопления</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-8">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label sr-only" for="textinput">Сумма</label>

                        <div class="col-md-4">
                            <div class="input-group">
                            <input id="field-amount" name="amount" type="text" placeholder="00.00"
                                   pattern="[0-9]+[.,]?[0-9]*"
                                   class="form-control input-lg">
                            <span class="input-group-addon">грн.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label sr-only" for="textinput">Дата</label>

                        <div class="col-md-4">
                            <?php $dateValue = date('d/m/Y') ?>
                            <input id="field-date" name="date" type="text" placeholder="<?php echo $dateValue ?>"
                                   class="form-control input-lg" value="<?php echo $dateValue ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>

                <div class="col-md-4">
                    <button type="submit" id="singlebutton" class="btn btn-success btn-block btn-lg">Сохранить
                    </button>
                </div>
            </div>

        </fieldset>
    </form>

    <table class="table">
        <caption class="text-left">Операции за сегодня</caption>
        <tr>
            <th>Категория</th>
            <th>Сумма</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($todayOperations as $operation): ?>
            <tr>
                <td><?php echo $operation->getName() ?></td>
                <td><?php echo $operation->getAmount() ?> <span class="currency"></span> грн.</td>
                <td>
                    <a href="<?php echo BASE_URL . '?controller=operation&action=delete&operation_id=' . $operation->getId() ?>"
                       onclick="return confirm('Удалить операцию?')">Удалить</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
</body>
</html>

