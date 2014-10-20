#!/bin/bash

echo ${1}
echo ${2}
echo ${3}
echo ${4}

cd ${1}
mysql -u ${3} -h localhost -p${4} -Bse "DROP DATABASE \`${2}\`;"
mysql -u ${3} -h localhost -p${4} -Bse "CREATE DATABASE IF NOT EXISTS  \`${2}\`;"

vendor/bin/doctrine-module orm:validate-schema
vendor/bin/doctrine-module orm:schema-tool:update --force
vendor/bin/doctrine-module orm:validate-schema
