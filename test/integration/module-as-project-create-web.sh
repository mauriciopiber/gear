#!/bin/bash


echo "Module As Project CLI"

base="/var/www/gear-package"
modulepath="$base/my-module"

rm -R /var/www/gear-package/my-module


php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $modulepath && script/deploy-development.sh

cd $modulepath && ant