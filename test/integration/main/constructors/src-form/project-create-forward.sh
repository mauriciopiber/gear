#!/bin/bash

build=${1}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

echo "Testing SRC - REPOSITORY"

base="/var/www/gear-package"

modulepath="$base/my-module"

gearpath="$base/gear"

sudo rm -R "$modulepath/src"
sudo rm -R "$modulepath/test"

sudo php public/index.php gear schema delete MyModule $base
sudo php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $gearpath && sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear-form.yml"
cd $modulepath && ant phpcs-docs
cd $modulepath && ant unit
cd $modulepath && ant unit-coverage
