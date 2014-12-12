#!/bin/bash
module="PiberNetworkTes"


php ./../../public/index.php gear module delete $module
php ./../../public/index.php gear module create $module
#php ./../../public/index.php gear db create $module --table=TipoServico
#php ./../../public/index.php gear db create $module --table=PrecoTipoServico
#php ./../../public/index.php gear db create $module --table=GrupoCusto
#php ./../../public/index.php gear db create $module --table=TipoCusto
#php ./../../public/index.php gear db create $module --table=StatusCusto
#php ./../../public/index.php gear db create $module --table=Custo

php ./../../public/index.php gear db create $module --table=Weekday
php ./../../public/index.php gear db create $module --table=ExpectedWorkingHours
php ./../../public/index.php gear db create $module --table=ExpectedPower
php ./../../public/index.php gear db create $module --table=ClientePessoaFisica
php ./../../public/index.php gear db create $module --table=ClientePessoaJuridica
php ./../../public/index.php gear db create $module --table=Cliente
php ./../../public/index.php gear db create $module --table=Endereco
php ./../../public/index.php gear db create $module --table=Estado
php ./../../public/index.php gear db create $module --table=Pais
php ./../../public/index.php gear db create $module --table=User
php ./../../public/index.php gear db create $module --table=Role
php ./../../public/index.php gear db create $module --table=Project
php ./../../public/index.php gear db create $module --table=UserStory
php ./../../public/index.php gear db create $module --table=UserStoryTime
exit

php ./../../public/index.php gear build $module --trigger="phpunit"
php ./../../public/index.php gear build $module --trigger="lint"
php ./../../public/index.php gear build $module --trigger="phpmd"
php ./../../public/index.php gear build $module --trigger="phpcpd"
php ./../../public/index.php gear build $module --trigger="phpunit-fast-coverage"