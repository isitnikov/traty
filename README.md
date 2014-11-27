Traty.net
=====

Создать аккаунт и начать пользоваться системой можно здесь: [traty.net](traty.net)
Для просмотра демо используйте Логин:demo Пароль:demo

Домашняя бухгалтерия с открытым исходным кодом.
Цель создать максимально простую систему управления и планирования бюджетом.
## Возможности и преимущества системы
 * Адапитвный дизайн который работает на всех устройствах мобильный, планшет и компьютер. Отпадает необходимость синхронизации, поддержки клиентов под разные платформы и т.д
 * Простой интерфейс с минимальным количеством полей
 * Используется только один счет для простоты. Записывается только расход/доход
 * Возможность планировать бюджет на месяц
 * Отчеты по дням, неделям или месяцам.

## Установка
 * Создай новую БД 
 _$mysqladmin -uroot -p create traty_
 * Импортируй dbdump.sql 
 _$mysql -uroot -p traty < db.dump.sql_
 * Скопируй файл настроек app/configs/config.php
 _cp app/configs/config.php.example app/configs/config.php_
 * Отредактируйте параметры конфига


