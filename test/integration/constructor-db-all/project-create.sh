#!/bin/bash

test=${1}

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
###$modulepath/vendor/bin/database my_module root gear
###sudo rm $modulepath/data/my-module.mysql.sql

sudo php public/index.php gear schema delete MyModule $base
sudo php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh

### can be turned off
###sudo cp "$fullpath/20160123222067_all_columns_db.php" $modulepath/data/migrations/

### can be turned off
###cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
###cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
###cd $modulepath && sudo php public/index.php gear database fix

cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear.yml"

### can be turned off
###cd $modulepath && sudo script/load.sh

#cd $modulepath && ant unit
cd $modulepath && ant protractor-tag -Dtag="@form-validate"
#
#cd $modulepath && ant protractor


#cd $modulepath && ant unit
###cd $modulepath && ant protractor-tag -Dtag="@all-columns-db-not-null"
###cd $modulepath && ant phpcs-docs

#cd $modulepath && ant unit-group -Ds=Controller.Create


#cd $modulepath && ant protractor-tag -Dtag="@all-columns-db-create"
#cd $modulepath && ant protractor-tag -Dtag="@all-columns-db-edit"
#cd $modulepath && ant protractor-tag -Dtag="@all-columns-db-view"
#cd $modulepath && ant protractor-tag -Dtag="@all-columns-db-list"





