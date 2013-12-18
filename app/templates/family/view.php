<?php
require APP_TEMPLATES_PATH . 'header.php';
?>
<div class="container">

    <?php if ($hasInvite): ?>
        <form class="form-horizontal" action="<?= App::getBaseUrl() . '?controller=family&action=accept'; ?>"
              method="post">
            <fieldset>

                <!-- Form Name -->
                <legend>Приглашение присоединится к семейному аккаунту</legend>
                <p>Вас приглашает присоединиться пользователь $username</p>
                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="control-label sr-only" for="button1id"></label>

                    <div class="col-md-12">
                        <button id="button1id" name="accept" class="btn btn-success">Принять</button>
                        <button id="button2id" name="decline" class="btn btn-danger">Отклонить</button>
                    </div>
                </div>

            </fieldset>
        </form>
    <?php endif ?>

    <?php if (!empty($members)): ?>
        <h2>Моя семья</h2>
        <div class="row">
            <?php foreach ($members as $member): ?>
            <div class="col-xs-6">
                <h4><?= $member->getUsername() ?></h4>
                <a href="<?= GeneralHelper::getUrl('family', 'remove', array('user_id' => $member->getId()))?>" class="btn btn-danger" onclick="return confirm('Вы уверены что хотите удалить члена семьи?')">
                    <span class="glyphicon glyphicon-remove"></span> Удалить
                </a>
            </div>
            <?php endforeach ?>
        </div>
        <div class="row">&nbsp;</div>

    <?php endif ?>

        <form class="form" method="post" action="<?= GeneralHelper::getUrl('family', 'invite') ?>">
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class="control-label" for="username">Пригласить пользователя</label>
                    <input id="username" name="username" type="text" placeholder="username"
                           class="form-control input-md">
                    <input type="hidden" name="from" value="<?= App::getUser()->getId() ?>"/>
                    <span class="help-block">Укажите имя зарегистрированного в системе пользователя </span>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="control-label" for="singlebutton"></label>
                    <button id="singlebutton" class="btn btn-primary" type="submit">Пригласить</button>
                </div>

            </fieldset>
        </form>
</div>
</body>
</html>
