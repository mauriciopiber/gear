#!/bin/bash
php ../../public/index.php gear module unload BjyAuthorize
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module create Teste

php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="User" --db="User"

#php ./../../public/index.php gear db create Teste --table="User" --columns="{\"email\": \"email\",\"password\": \"password-confirm\", \"uid\" : \"unique-id\"}"
php ./../../public/index.php gear db create Teste --table="Role"

php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php ../../public/index.php gear module load BjyAuthorize --before=ZfcBase
php ../../public/index.php gear module build Teste --trigger=phpunit