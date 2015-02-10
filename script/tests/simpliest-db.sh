#!/bin/bash
php ./../../public/index.php gear db create Teste --table="Email" --user="all"
exit 1
#desliga a segurança
php ../../public/index.php gear module unload BjyAuthorize
#deleta módulo
php ../../public/index.php gear module delete Teste
#cria módulo
php ../../public/index.php gear module create Teste
#cria crud

#cria estrutura auxiliar
php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="Role" --db="Role"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="User" --db="User"

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
php ../../public/index.php gear module build Teste --trigger=unit
php ../../public/index.php gear module build Teste --trigger=acceptance
php ../../public/index.php gear module build Teste --trigger=functional

exit 1