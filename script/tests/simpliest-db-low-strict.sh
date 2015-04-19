#!/bin/bash

php ./../../public/index.php gear module unload BjyAuthorize
php ./../../public/index.php gear module delete Teste

exit 1
php ./../../public/index.php gear module create Teste


php ./../../public/index.php gear module db create Teste --table="Email" --user="low-strict"
#php ./../../public/index.php gear db create Teste --table="Theme" --user="low-strict"

php ./../../public/index.php gear project fixture --reset-autoincrement
php ./../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php ./../../public/index.php gear module load BjyAuthorize --before=ZfcBase
php ./../../public/index.php gear database mysql dump /var/www/html/modules/module/Teste/data/ teste.mysql.sql

exit 1
php ./../../public/index.php gear module build Teste --trigger=codeception

exit 1

php ./../../public/index.php gear module build Teste --trigger=acceptance
php ./../../public/index.php gear module build Teste --trigger=functional


exit 1
