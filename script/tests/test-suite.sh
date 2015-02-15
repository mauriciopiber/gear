#!/bin/bash

#desliga a segurança
#php ../../public/index.php gear module unload BjyAuthorize
#deleta módulo
php ../../public/index.php gear module delete Teste
#cria módulo
php ../../public/index.php gear module create Teste
#cria crud
php ./../../public/index.php gear db create Teste --table="TestingSuite" --columns="{\"test_varchar_email\": \"email\",\"test_decimal_money_pt_br\": \"money-pt-br\",\"test_date_pt_br\": \"date-pt-br\",\"test_datetime_pt_br\": \"datetime-pt-br\",\"test_int_checkbox\": \"checkbox\",\"test_varchar_imagem_upload\": \"imagem-upload\",\"test_tinyint_checkbox\": \"checkbox\"}"
php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="User" --db="User"
#gera dump dos dados para teste.
php ../../public/index.php gear database mysql dump /var/www/html/modules/module/Teste/data/ teste.mysql.sql
exit 1

#aqui limpa o banco de dados e carrega fixture + acl
php ../../public/index.php gear project resetAcl
php ../../public/index.php gear database autoincrement
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl

#aqui reiniciar o cache pra usar os novos acls.
/usr/bin/expect ./script/utils/clear-memcached.sh

#gera dump dos dados para teste.
php ../../public/index.php gear database mysql dump /var/www/html/modules/module/Teste/data/ teste.mysql.sql

#liga a segurança
php ../../public/index.php gear module load BjyAuthorize --before=ZfcBase

#php ../../public/index.php gear module build Teste --trigger=phpunit


php ../../public/index.php gear module build Teste --trigger=acceptance
php ../../public/index.php gear module build Teste --trigger=functional
php ../../public/index.php gear module build Teste --trigger=unit


exit 1