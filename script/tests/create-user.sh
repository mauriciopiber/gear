#!/bin/bash
#php ../../public/index.php gear unload BjyAuthorize
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module create Teste
php ./../../public/index.php gear db create Teste --table="User" --columns="{\"email\": \"email\",\"password\": \"password-confirm\", \"uid\" : \"unique-id\"}"
php ./../../public/index.php gear db create Teste --table="Role"

php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/clear-memcached.sh
#php ../../public/index.php gear load BjyAuthorize --before=ZfcBase
php ../../public/index.php gear build Teste --trigger=phpunit