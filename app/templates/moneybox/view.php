<div class="row">
    <div class="col-xs-6">
        <h3>Копилка</h3>
    </div>
    <div class="col-xs-6">
        <h3 class="text-right"><small><a href="<?= GeneralHelper::getUrl('moneybox', 'edit')?>">Редактировать</a></small></h3>
    </div>
</div>
<?php foreach ($this->moneyboxCollection as $moneyBox): ?>
<div class="moneybox">
    <div class="row">
        <div class="col-xs-6">
            <h4 class="title"><?= $moneyBox->getName() ?></h4>
        </div>
        <div class="col-xs-6 text-right">
            <h4 class="final-amount"><?= GeneralHelper::renderAmount($moneyBox->getCost()) ?></h4>
        </div>
    </div>
    <ul class="properties list-unstyled">
        <?php
        $today = GeneralHelper::getDateTime(time());
        $date = GeneralHelper::getDateTime($moneyBox->getDate());
        $interval = $today->diff($date);
        $monthAmount = ($moneyBox->getCost() - $moneyBox->getAccumulated()) / $interval->format('%a');
        ?>
        <li>Запланированная дата: <?= GeneralHelper::getDateValue($moneyBox->getDate(), 'render') ?></li>
        <li>Ежедневная сумма: <?= GeneralHelper::renderAmount($monthAmount) ?></li>
        <li>Осталось: <?= GeneralHelper::renderAmount($moneyBox->getCost() - $moneyBox->getAccumulated()) ?></li>
        <li>Накопленно: <?= GeneralHelper::renderAmount($moneyBox->getAccumulated()) ?></li>
    </ul>
    <?php
    $percent = $moneyBox->getAccumulated() * 100 / $moneyBox->getCost();
    ?>
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percent ?>%;">
            <span class=""><?= round($percent, 2) ?> %</span>
        </div>
    </div>
    <div class="row">&nbsp;</div>
</div>
<?php endforeach ?>