<div class="row">
    <div class="col-xs-6">
        <h3>Копилка</h3>
    </div>
    <div class="col-xs-6">
        <h3 class="text-right"><small><a href="<?= GeneralHelper::getUrl('moneybox', 'view')?>">Готово</a></small></h3>
    </div>
</div>
<h4 class="title"><a href="<?= GeneralHelper::getUrl('moneybox', 'form') ?>">Добавить новую цель</a></h4>
<?php foreach ($this->moneyboxCollection as $moneyBox): ?>
    <div class="moneybox">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?= $moneyBox->getName() ?></h4>
            </div>
            <div class="col-xs-6 text-right">
                <h4 class="action"><small><a href="<?= GeneralHelper::getUrl('moneybox', 'form', array('id' => $moneyBox->getId()))?>">Редактировать</a></small></h4>
            </div>
        </div>
    </div>
<?php endforeach ?>
