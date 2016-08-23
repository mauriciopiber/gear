#!/bin/bash

build=${1}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
base="/var/www/gear-package"

gearpath="$base/gear"

module=PiberMoney
modulepath="$base/piber-money"

date="$(date +'%Y%m%d%H%M%S')"

#$modulepath/vendor/bin/database piber_money root gear


#sudo php public/index.php gear schema delete $module $base
#sudo php public/index.php gear module-as-project create $module $base --type=web --force

sudo rm $modulepath/data/migrations/*expense.php
sudo cp "$fullpath/expense.php" "$modulepath/data/migrations/${date}_expense.php"

cd $modulepath && sudo vendor/bin/phinx migrate
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize
cd $modulepath && sudo php public/index.php gear database fix

cd $gearpath && sudo php public/index.php gear module construct $module $base --file="$basedir/expense.yml"

cd $modulepath && sudo script/load.sh
cd $modulepath && ant
