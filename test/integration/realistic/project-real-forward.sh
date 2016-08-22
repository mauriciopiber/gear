#!/bin/bash

build=${1}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

echo $fullpath

echo "Module As Project CLI"

base="/var/www/gear-package"
gearpath="$base/gear"


module="MyModule"
modulepath="$base/my-module"

$modulepath/vendor/bin/database my_module root gear
sudo rm $modulepath/data/my-module.mysql.sql

#MODULE

sudo php public/index.php gear schema delete $module $base
sudo php public/index.php gear module-as-project create $module $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh

sudo chmod 777 -R $modulepath

## MVC

sudo rm $modulepath/data/migrations/40160123222067_all_columns_db.php
sudo cp "$fullpath/40160123222067_all_columns_db.php" $modulepath/data/migrations/
cd $modulepath && sudo vendor/bin/phinx migrate
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize
cd $modulepath && sudo php public/index.php gear database fix

cd $gearpath && sudo php public/index.php gear module construct $module $base --file="$basedir/gear-real.yml"
cd $modulepath && sudo script/load.sh

cd $modulepath && ant

