#!/bin/bash

module="RecordTime"

php  ../../public/index.php gear module delete $module
#cria módulo
php ../../public/index.php gear module create $module
#cria crud

php ../../public/index.php gear src create $module --type="Entity" --name="Role" --db="Role"
php ../../public/index.php gear src create $module --type="Entity" --name="User" --db="User"
php ./../../public/index.php gear db create $module --table="Record"
php ./../../public/index.php gear db create $module --table="TimeRecord" --columns="{\"start_datetime\": \"datetime-pt-br\",\"end_datetime\": \"datetime-pt-br\"}"

php ../../public/index.php gear module unload BjyAuthorize
#aqui limpa o banco de dados e carrega fixture + acl
php ../../public/index.php gear project resetAcl
php ../../public/index.php gear database autoincrement
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh
php ../../public/index.php gear module load BjyAuthorize --before=ZfcBase