<h3>Новая цель</h3>
<div class="row">
    <div class="col-md-12">
        <form role="form" method="post" action="<?= GeneralHelper::getUrl('moneybox', 'save') ?>">
            <input type="hidden" name="id" value="<?= $this->moneybox->getId() ?>" />
            <p class="help-block">
                Ваши цели должны быть <a href="http://ru.wikipedia.org/wiki/SMART" target="_blank">S.M.A.R.T</a>
                <ul>
                <li>конкретный (Specific)</li>
                <li>измеримый (Measurable)</li>
                <li>достижимый (Attainable)</li>
                <li>значимый (Relevant)</li>
                <li>соотносимый с конкретным сроком (Time-bounded)</li>
                </ul>
            </p>
            <div class="form-group">
                <label for="name" class="sr-only">Имя цели</label>
                <input type="text" class="form-control" id="name" placeholder="Имя цели" name="name" value="<?= $this->moneybox->getName() ?>">
                <p class="help-block small">Пример цели: Квартира, Ремонт, Утюг</p>
            </div>
            <div class="form-group">
                <label for="cost" class="sr-only">Полная стоимость цели</label>
                <input type="text" class="form-control" id="cost" placeholder="Полная стоимость цели" name="cost" value="<?= $this->moneybox->getCost() ?>">
                <p class="help-block small">Укажите полную стоимость цели</p>
            </div>
            <div class="form-group">
                <label for="acc" class="sr-only">Сколько уже накопленно</label>
                <input type="text" class="form-control" id="acc" placeholder="Сколько уже накопленно" name="accumulated" value="<?= $this->moneybox->getAccumulated() ?>">
                <p class="help-block small">Сколько уже накопленно у вас на цель</p>
            </div>
            <div class="form-group">
                <label for="date" class="sr-only">Дата выполнения цели</label>
                <input type="text" class="form-control" id="date" placeholder="Дата выполнения цели" name="date" value="<?= GeneralHelper::getDateValue($this->moneybox->getDate(), 'render') ?>">
                <p class="help-block small">Дата выполнения цели в формате: 12/12/2020</p>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
            <a href="<?= GeneralHelper::getUrl('moneybox', 'edit') ?>" class="btn btn-default">Отменить</a>
        </form>
    </div>
</div>
