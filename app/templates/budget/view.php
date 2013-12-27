<?php
require APP_TEMPLATES_PATH . 'header.php';
?>
<div class="container">
    <h3 class="text-primary">Бюджет <small>на месяц</small></h3>

    <?php
    $categories = array('Продукты', 'Транспорт', 'Одежда', 'Авто', 'Отдых', 'Еда вне дома', 'Развлечения');
    ?>
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th>В среднем</th>
                    <th>Декабрь 2013</th>
                </tr>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td>Продукты</td>
                    <td><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND) ?></td>
                    <td><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND) ?></td>
                </tr>
                <?php endforeach ?>
            </table>
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Бюджет</th>
                </tr>

                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category ?></td>
                    <td class="text-right"><input type="text" name="amount" placeholder="00.00" class="form-control" /> </td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

