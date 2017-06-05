## Install
- create host "nv-message-list.com" or create facebook apps, and put keys in "www/app/conlig.php"  F_APP_ID, F_APP_SECRET ( apps should be public and added your address name in white list)
- create dataBase "nv-message-list" with db_collation = "utf8_general_ci" - and put accesses in "www/app/conlig.php"
- import nv-message-list.sql in DB - should be create tables "comments", "messages", "replys", "users"

## I used
- PHP 7.1.5-1+deb.sury.org~zesty+2
- MySQL 5.7.18-0ubuntu0.17.04.1 - (Ubuntu)
- Apache/2.4.25 (Ubuntu)

## Fixed
- + страница 404 имеет статус 200;
- + используется оператор подавления ошибок в router вместо корректной обработки неправильно введенных путей. Если его убрать - появляются Notice.
- + в sql нет foreign keys;
- + использование global переменной в паттерне MVC;
- + значительная часть view в helper-функции.
- js, css в отдельных файлах. - это не понял..Почому это плохо?Из за числа конектов? - переместить же 1 мин..