<?php
require 'header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">




            <form role="form" method="post"

                  action="<?php echo BASE_URL . '?controller=operation&action=save' ?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend class="sr-only">Расходы</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="control-label sr-only" for="category">Категория</label>

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
                            <option value="Домашние животные">Питомцы</option>
                            <option value="Долги, кредиты">Долги, кредиты</option>
                            <option value="Накопления">Накопления</option>
                            <option value="Связь">Связь</option>
                            <option value="Привычки">Привычки</option>
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

                            <?php echo $operation->getName() ?></td>
                        <td class="text-right"><?php echo $operation->getAmount() ?> <span class="currency"></span> грн.</td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

