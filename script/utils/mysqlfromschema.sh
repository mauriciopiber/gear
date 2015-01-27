#!/bin/bash

echo ${1}
echo ${2}
echo ${3}
echo ${4}
#exit 1;

cd ${1}
#mysql -u ${3} -h localhost -p${4} -Bse "DROP DATABASE \`${2}\`;"
mysql -u ${3} -h localhost -p${4} -Bse "CREATE DATABASE IF NOT EXISTS  \`${2}\`;"

#php app/console doctrine:database:create
vendor/bin/doctrine-module orm:validate-schema
vendor/bin/doctrine-module orm:schema-tool:create
#vendor/bin/doctrine-module orm:schema-tool:update --force
vendor/bin/doctrine-module orm:validate-schema
