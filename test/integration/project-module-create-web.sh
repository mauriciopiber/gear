#!/bin/bash


echo "Module As Project CLI"

base="/var/www/gear-package"
modulepath="$base/my-module"

rm -R /var/www/gear-package/my-module


sudo php public/index.php gear module create MyModule $base --type=web --force --as-project

cd $modulepath && sudo script/deploy-development.sh

cd $modulepath && ant