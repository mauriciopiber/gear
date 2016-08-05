#!/bin/bash

build=${1}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

echo $fullpath

echo "Module As Project CLI"

base="/var/www/gear-package"
modulepath="$base/my-module"
gearpath="$base/gear"

sudo rm -R "$modulepath/src"
sudo rm -R "$modulepath/test"


### can be turned off
### $modulepath/vendor/bin/database my_module root gear
### sudo rm $modulepath/data/my-module.mysql.sql

sudo php public/index.php gear schema delete MyModule $base
sudo php public/index.php gear module-as-project create MyModule $base --type=web --force

### can be turned off
### sudo rm $modulepath/data/migrations/20160123222067_all_columns_db.php
### sudo cp "$fullpath/20160123222067_all_columns_db.php" $modulepath/data/migrations/

###cd $modulepath && sudo script/deploy-development.sh

### can be turned off
### cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
### cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
### cd $modulepath && sudo php public/index.php gear database fix

cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear-all-columns.yml"

### OK - cd $modulepath && ant phpunit
### OK - cd $modulepath && ant phpunit-group -Dgroup=Repository
### OK - cd $modulepath && ant phpunit-coverage
### OK - cd $modulepath && ant phpunit-coverage-group -Dgroup=Repository
### OK - cd $modulepath && ant phpunit-benchmark
### OK - cd $modulepath && ant phpunit-benchmark-group -Dgroup=Repository
### OK - cd $modulepath && ant phpunit-coverage-benchmark
### OK - cd $modulepath && ant phpunit-coverage-benchmark-group -Ds=Repository
cd $modulepath && ant unit

