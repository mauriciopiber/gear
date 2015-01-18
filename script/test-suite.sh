#!/bin/bash


php ../../public/index.php gear unload BjyAuthorize
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module create Teste
php ./../../public/index.php gear db create Teste --table="TestingSuite" --columns="{\"test_varchar_email\": \"email\",\"test_decimal_money_pt_br\": \"money-pt-br\",\"test_date_pt_br\": \"date-pt-br\",\"test_datetime_pt_br\": \"datetime-pt-br\",\"test_int_checkbox\": \"checkbox\",\"test_varchar_imagem_upload\": \"imagem-upload\",\"test_tinyint_checkbox\": \"checkbox\"}"
php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="User" --db="User"


php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/clear-memcached.sh
php ../../public/index.php gear load BjyAuthorize --before=ZfcBase
php ../../public/index.php gear build Teste --trigger=phpunit


