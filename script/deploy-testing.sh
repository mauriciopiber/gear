#!/bin/bash

sudo composer update -o

database=$(php -r '$global = require_once("config/autoload/global.php"); echo $global["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["dbname"***REMOVED***;')
username=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["user"***REMOVED***;')
password=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["password"***REMOVED***;')

bin/database $database $username $password
mysql -u$username -p$password $database < data/gear.mysql.sql

chmod 777 -R build
chmod 777 -R data/session
chmod 777 -R data/logs
chmod 777 -R data/cache
chmod 777 -R data/DoctrineModule
chmod 777 -R data/DoctrineORMModule

php public/index.php gear module dump-autoload Gear
