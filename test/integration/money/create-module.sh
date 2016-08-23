#!/bin/bash

build=${1}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
base="/var/www/gear-package"

gearpath="$base/gear"

module=PiberMoney
modulepath="$base/piber-money"


echo "$fullpath Module Money"

sudo rm -R "$modulepath/src"
sudo rm -R "$modulepath/test"
sudo rm -R "$modulepath/public"

$modulepath/vendor/bin/database my_module root gear


sudo php public/index.php gear schema delete $module $base
sudo php public/index.php gear module-as-project create $module $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh

cd $modulepath && ant