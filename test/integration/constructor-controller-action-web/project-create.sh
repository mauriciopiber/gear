#!/bin/bash

basedir=$(dirname "$0")
echo "$basedir"

echo "Module As Project CLI"

base="/var/www/gear-package"
modulepath="$base/my-module"

#rm -R /var/www/gear-package/my-module

sudo php public/index.php gear schema delete MyModule $base
sudo php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh

sudo php public/index.php gear module construct MyModule $base --file="$basedir/gear.yml"

#cd $modulepath && ant


