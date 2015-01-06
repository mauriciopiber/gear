#!/bin/bash
php ../../public/index.php gear unload Teste
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module-light create Teste --doctrine --doctrine-fixture --unit --ci --gear
php ../../public/index.php gear src create Teste --type="Fixture" --name="PaisFixture" --db="Pais"
php ../../public/index.php gear src create Teste --type="Fixture" --name="UserFixture" --db="User"
php ../../public/index.php gear src create Teste --type="Fixture" --name="RoleFixture" --db="Role"
cat ../../module/Teste/schema/module.json
php ../../public/index.php gear build Teste --trigger=phpunit-fast-coverage
ln -s /var/www/html/modules/module/Teste/build/coverage /var/www/html/modules/public/coverage-testing
exit 1
php ../../public/index.php gear src create Teste --type="Entity" --name="Pais" --db="Pais"
php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
#php ../../public/index.php gear build Teste --trigger=quality
