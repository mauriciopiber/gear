#!/bin/bash

ls -l vendor/autoload.php &> /dev/null

if [ "$?" != "0" ***REMOVED***; then
    composer update
fi;

database=$(php -r '$global = require_once("config/autoload/global.php"); echo $global["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["dbname"***REMOVED***;')
host=$(php -r '$global = require_once("config/autoload/global.php"); echo $global["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["host"***REMOVED***;')
username=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["user"***REMOVED***;')
password=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["password"***REMOVED***;')

mysql -u $username -h $host -p$password -Bse "DROP DATABASE $database;" &> /dev/null
mysql -u $username -h $host -p$password -Bse "CREATE DATABASE IF NOT EXISTS $database;"  &> /dev/null

echo "Banco de dados $database criado."
echo -n "[OK***REMOVED***"

composer dump-autoload
