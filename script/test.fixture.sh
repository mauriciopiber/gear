#!/bin/bash

php ../../public/index.php gear unload Teste
php ../../public/index.php gear unload BjyAuthorize
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module create Teste
php ../../public/index.php gear project deploy development
php ./../../public/index.php gear db create Teste --table="Pais"
php ./../../public/index.php gear db create Teste --table="Estado" --user=low-strict
php ./../../public/index.php gear db create Teste --table="Endereco" --user=strict
php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import
php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/clear-memcached.sh
php ../../public/index.php gear load BjyAuthorize --before=ZfcBase
php ../../public/index.php gear build Teste --trigger=phpunit
exit 1


#php ../../public/index.php gear build Teste --trigger=phpunit-fast-coverage
#ln -s /var/www/html/modules/module/Teste/build/coverage /var/www/html/modules/public/coverage-testing
exit 1