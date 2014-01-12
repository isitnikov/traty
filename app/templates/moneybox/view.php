<div class="row">
    <div class="col-xs-6">
        <h3>Копилка</h3>
    </div>
    <div class="col-xs-6">
        <h3><small><a href="#">Добавить цель</a></small></h3>
    </div>
</div>
<div class="moneybox">
    <div class="row">
        <div class="col-xs-6">
            <h4 class="title">Квартира</h4>
        </div>
        <div class="col-xs-6">
            <h4 class="final-amount"><?= GeneralHelper::renderAmount(500000) ?></h4>
        </div>
    </div>
    <ul class="properties list-unstyled">
        <li>Ежемесячная сумма: <?= GeneralHelper::renderAmount(5000) ?></li>
        <li>Запланированная дата: 01/01/2016</li>
        <li>Накопленно: <?= GeneralHelper::renderAmount(5000) ?></li>
    </ul>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
            <span class="sr-only">60% Complete</span>
        </div>
    </div>
    <div class="row">&nbsp;</div>
</div>
