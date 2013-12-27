<?php
require APP_TEMPLATES_PATH . 'header.php';
?>
<div class="container">
    <h3 class="text-primary">Бюджет <small>на месяц</small></h3>

    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th>Бюджет</th>
                    <th>Декабрь 2013</th>
                    <th>В среднем</th>
                </tr>
                <tr>
                    <td>Продукты</td>
                    <td><input type="text" name="amount" placeholder="Сумма бюджета" class="form-control" /> </td>
                    <td><?= GeneralHelper::renderAmount(rand(1000, 3000), Category::TYPE_SPEND)?></td>
                    <td><?= GeneralHelper::renderAmount(rand(1000, 3000), Category::TYPE_SPEND)?></td>
                </tr>
            </table>
                </div>
        </div>
    </div>
</div>
</body>
</html>

