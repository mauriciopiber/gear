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

sudo php public/index.php gear schema delete MyModule $base
sudo php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$gearbase/test/integration/benchmark/gear-all-columns.yml"
cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$gearbase/test/integration/benchmark/gear-type-column.yml"
cd $modulepath && ant "$build-group" -Dgroup=Repository
