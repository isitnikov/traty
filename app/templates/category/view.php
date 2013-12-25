<?php
require APP_TEMPLATES_PATH . 'header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="form" role="form" action="<?php echo GeneralHelper::getUrl('category', 'save') ?>" style="margin-bottom: 30px" method="post">
                <div class="form-group">
                    <label class="sr-only" for="name">Категория</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Имя категории">
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="type" id="optionsRadios1" value="<?= Category::TYPE_SPEND?>" checked>
                        Категория расходов
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="type" id="optionsRadios2" value="<?= Category::TYPE_INCOME ?>">
                        Категория доходов
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table" >
                <tr>
                    <th>Категория</th>
                    <th class="text-right">Статус</th>
                </tr>
                <?php foreach ($allCategories as $category): ?>
                    <tr>
                        <td>
                            <?php
                                $labelClass = 'label-primary';
                                $label = 'Расход';
                                if ($category->getType() == Category::TYPE_INCOME) {
                                    $labelClass = 'label-success';
                                    $label = 'Доход';
                                }
                            ?>
                            <span class="label <?= $labelClass ?>"><?= $label ?></span>
                            <?= $category->getName() ?>
                        </td>
                        <td class="text-right">Включена</td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>