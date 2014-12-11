#!/bin/bash
module="PiberNetworkTest"
php ./../../public/index.php gear module delete $module
php ./../../public/index.php gear module create $module
php ./../../public/index.php gear db create $module --table=TipoServico
php ./../../public/index.php gear db create $module --table=PrecoTipoServico
php ./../../public/index.php gear db create $module --table=GrupoCusto
php ./../../public/index.php gear db create $module --table=TipoCusto
php ./../../public/index.php gear db create $module --table=StatusCusto
php ./../../public/index.php gear db create $module --table=Custo
php ./../../public/index.php gear build $module --trigger="phpunit"
php ./../../public/index.php gear build $module --trigger="lint"
php ./../../public/index.php gear build $module --trigger="phpmd"
php ./../../public/index.php gear build $module --trigger="phpcpd"
php ./../../public/index.php gear build $module --trigger="phpunit-fast-coverage"