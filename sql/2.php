<?php
require '../app/App.php';


$sql = "ALTER TABLE  `operation` ADD  `category` INT( 10 ) NOT NULL , ADD INDEX (  `category` )";

App::getConnection()->query($sql);

$categories = array(
    "Транспорт",
    "Продукты",
    "Одежда, косметика",
    "Отдых",
    "Медицина",
    "Авто",
    "Жилье",
    "Еда вне дома",
    "Обучение",
    "Работа",
    "Спорт",
    "Разное",
    "Домашние животные",
    "Долги, кредиты",
    "Накопления",
);

foreach ($categories as $category) {
    App::getConnection()->insert('category', array('id' => null, 'name' => $category, 'type' => 1));
    $categoryId = App::getConnection()->lastInsertId('category');

    $where = App::getConnection()->quoteInto('name = ?', $category);
    App::getConnection()->update('operation', array('category' => $categoryId), $where);
}





$categories = array(
    "Зарплата",
    "Подработка",
    "Премия",
    "Проценты с инвестиций",
    "Разное",
);

foreach ($categories as $category) {
    App::getConnection()->insert('category', array('id' => null, 'name' => $category, 'type' => 2));
    $categoryId = App::getConnection()->lastInsertId('category');

    $where = App::getConnection()->quoteInto('name = ?', $category);
    App::getConnection()->update('operation', array('category' => $categoryId), $where);
}

$sql = "ALTER TABLE `operation` DROP `name`";
App::getConnection()->query($sql);
