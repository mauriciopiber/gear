#!/bin/bash
project=${2}
user=${3}
pass=${4}

cd ${1}

mysql -u $user -h localhost -p$pass -Bse "CREATE DATABASE IF NOT EXISTS  \$project\;"

vendor/bin/doctrine-module orm:validate-schema
vendor/bin/doctrine-module orm:schema-tool:update --force
vendor/bin/doctrine-module orm:validate-schema

php public/index.php rule clear
php public/index.php rule import
mysqldump -h localhost -uroot -pgear $project > "/data/mysql-$(date +'%m-%d-%Y-%H%m%s').sql"

#vendor/bin/doctrine-module dbal:run-sql "INSERT INTO user(id_user, email, password, username, state, uid, created, updated) VALUES (1,[value-2***REMOVED***,[value-3***REMOVED***,[value-4***REMOVED***,[value-5***REMOVED***,[value-6***REMOVED***,[value-7***REMOVED***,[value-8***REMOVED***)"