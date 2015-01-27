#!/bin/bash

module="MyModuleConstructorTest"

php ../../public/index.php gear module delete $module
php ../../public/index.php gear module create $module

#php ./../../public/index.php gear src create $module --type="Repository" --name="MyNewRepository" --abstract


#php ./../../public/index.php gear src create $module --type="Repository" --name="SecondRepository" --extends="MyNewRepository"
#php ./../../public/index.php gear src create $module --type="Repository" --name="ThirdRepository" --extends="SecondRepository" --db="GrupoCusto"

#primeiro - Adicionar apenas abstract e testar 100%.
#segundo  - Adicionar um repository sem DB e testar 100%.
#terceiro - Adicionar um repository com DB e testar 100%.

php ../../public/index.php gear project setUpAcl
/usr/bin/expect ./script/utils/clear-memcached.sh

php ../../public/index.php gear build $module --trigger=unit-coverage

exit 1
#php ../../public/index.php gear build $module --trigger=phpunit-fast-coverage

#ln -s /var/www/html/modules/module/$module/build/coverage/coverage /var/www/html/modules/public/code-coverage