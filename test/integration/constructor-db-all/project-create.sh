#!/bin/bash

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

echo $fullpath

echo "Module As Project CLI"

base="/var/www/gear-package"
modulepath="$base/my-module"
gearpath="$base/gear"

sudo rm -R "$modulepath/src"
sudo rm -R "$modulepath/test"

$modulepath/vendor/bin/database my_module root gear

sudo php public/index.php gear schema delete MyModule $base
sudo php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh


sudo cp "$fullpath/20160123222067_all_columns_db.php" $modulepath/data/migrations/

cd $modulepath && sudo vendor/bin/phinx migrate

cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

cd $modulepath && sudo php public/index.php gear database fix

cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear.yml"

cd $modulepath && sudo script/load.sh

cd $modulepath && ant unit
cd $modulepath && ant protractor




