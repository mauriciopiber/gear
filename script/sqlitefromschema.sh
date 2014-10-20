#!/bin/bash
echo "Generating sqlite dump and db from doctrine entities"

echo ${1}
echo ${2}

export APP_ENV=testing
../../vendor/bin/doctrine-module orm:schema-tool:update --force
../../vendor/bin/doctrine-module orm:validate-schema

echo "Sqlite from Schema Ok"