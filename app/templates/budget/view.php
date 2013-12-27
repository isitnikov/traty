<?php
require APP_TEMPLATES_PATH . 'header.php';
?>
<div class="container">
    <?php
    $categories = array('Продукты', 'Транспорт', 'Одежда', 'Авто', 'Отдых', 'Еда вне дома', 'Развлечения');
    ?>
    <div class="row">
        <div class="col-lg-6">
            <h3 class="text-primary">Бюджет
                <small>на месяц</small>
            </h3>
            <div class="table-responsive">
                <table class="table">
                    <tr class="active">
                        <th><span class="text-danger">Расходы</span></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                    </tr>
                    <tr>
                        <th><small>Бюджет</small></th>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                    </tr>
                    <tr>
                        <th><small>Фактически</small></th>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr class="active">
                        <th><span class="text-success">Доходы</span></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                    </tr>
                    <tr>
                        <th><small>Бюджет</small></th>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                    </tr>
                    <tr>
                        <th><small>Фактически</small></th>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr class="active">
                        <th><span class="text-danger">Баланс</span></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                        <th class="text-right"><small>Ноябрь 2013</small></th>
                    </tr>
                    <tr>
                        <th><small>Бюджет</small></th>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                    </tr>
                    <tr>
                        <th><small>Фактически</small></th>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND)?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <h3 class="text-primary">Задать бюджет
                <small>на месяц</small>
            </h3>
            <table class="table">
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Расходы в среднем</th>
                    <th class="text-right">Бюджет</th>
                </tr>

                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category ?></td>
                        <td class="text-right"><?= GeneralHelper::renderAmount(rand(1000, 10000), Category::TYPE_SPEND) ?></td>
                        <td class="text-right" width="30%"><input type="text" name="amount" placeholder="00.00"
                                                                  class="form-control"/></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>

