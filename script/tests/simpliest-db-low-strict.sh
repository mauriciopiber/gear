#!/bin/bash

#php ./../../public/index.php gear module unload BjyAuthorize
#php ./../../public/index.php gear module delete Teste
#php ./../../public/index.php gear module create Teste
php ./../../public/index.php gear db create Teste --table="Email" --user="low-strict"
php ./../../public/index.php gear module build Teste --trigger=phpcs

exit 1

php ./../../public/index.php gear project fixture --reset-increment
php ./../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php ./../../public/index.php gear module load BjyAuthorize --before=ZfcBase
php ./../../public/index.php gear database mysql dump /var/www/html/modules/module/Teste/data/ teste.mysql.sql
php ./../../public/index.php gear module build Teste --trigger=phpcs


exit 1