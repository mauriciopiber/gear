#!/bin/bash

#php ../../public/index.php gear module unload BjyAuthorize
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module create Teste
php ./../../public/index.php gear db create Teste --table="Email" --user="low-strict"
php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
exit 1;
#php ../../public/index.php gear module build Teste --trigger=phpcs

#exit 1;

php ./../../public/index.php gear src create Teste --type="Fixture" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="User" --db="User"

php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php ../../public/index.php gear module load BjyAuthorize --before=ZfcBase
php ../../public/index.php gear module build Teste --trigger=phpunit


exit 1