#!/bin/bash
module="TestDataUser"

php ./../../public/index.php gear drop table phinxlog


php ./../../public/index.php gear module delete $module
php ./../../public/index.php gear module create $module
php ./../../public/index.php gear db create $module --table=Pais --user=strict
php ./../../public/index.php gear project setUpEntity $module --entity=User

#php ./../../public/index.php gear build $module --trigger="phpcs"
#php ./../../public/index.php gear build $module --trigger="phpunit"
#php ./../../public/index.php gear build $module --trigger="lint"
#php ./../../public/index.php gear build $module --trigger="phpmd"
#php ./../../public/index.php gear build $module --trigger="phpcpd"
#php ./../../public/index.php gear build $module --trigger="phpunit-fast-coverage"
exit 1
php ./../../public/index.php gear module delete $module
php ./../../public/index.php gear module create $module
php ./../../public/index.php gear db create $module --table=Pais

php ./../../public/index.php gear module delete $module
php ./../../public/index.php gear module create $module
php ./../../public/index.php gear db create $module --table=Pais --user=all

php ./../../public/index.php gear module delete $module
php ./../../public/index.php gear module create $module
php ./../../public/index.php gear db create $module --table=Pais --user=low-strict
