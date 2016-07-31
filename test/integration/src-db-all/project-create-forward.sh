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

#cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear-repository.yml"
#cd $modulepath && ant unit-group -Ds=Repository
#cd $modulepath && ant unit-group-coverage -Dgroup=Repository

cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear-repository-factory.yml"
cd $modulepath && ant unit-group -Ds=Form
cd $modulepath && ant unit-group-coverage -Dgroup=Form