#!/bin/bash

build=${1}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
base="/var/www/gear-package"

gearpath="$base/gear"

module=PiberMoney
modulepath="$base/piber-money"

date="$(date +'%Y%m%d%H%M%S')"


sudo rm -R "$modulepath/src"
sudo rm -R "$modulepath/test"
sudo rm -R "$modulepath/public"
#sudo rm -R "$modulepath/data/migrations"

$modulepath/vendor/bin/database piber_money root gear


sudo php public/index.php gear schema delete $module $base
sudo php public/index.php gear module-as-project create $module $base --type=web --force

sudo rm $modulepath/data/migrations/*wallet.php
sudo cp "$fullpath/wallet.php" "$modulepath/data/migrations/${date}_wallet.php"

cd $modulepath && sudo vendor/bin/phinx migrate
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize
cd $modulepath && sudo php public/index.php gear database fix

cd $gearpath && sudo php public/index.php gear module construct $module $base --file="$basedir/wallet.yml"

cd $modulepath && sudo script/load.sh
cd $modulepath && ant
