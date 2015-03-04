#!/bin/bash

module="AdminCoola"

php  ../../public/index.php gear module delete $module
#cria módulo
php ../../public/index.php gear module create $module
#cria crud

php ../../public/index.php gear src create $module --type="Entity" --name="Role" --db="Role"
php ./../../public/index.php gear src create $module --type="Fixture" --name="Role" --db="Role"
php ./../../public/index.php gear db create $module --table="User" --columns="{\"email\": \"email\",\"password\": \"password-verify\",\"uid\": \"unique-id\", \"state\": \"checkbox\"}"

php ../../public/index.php gear module unload BjyAuthorize
#aqui limpa o banco de dados e carrega fixture + acl
php ../../public/index.php gear project resetAcl
php ../../public/index.php gear database autoincrement
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php ../../public/index.php gear module load BjyAuthorize --before=ZfcBase