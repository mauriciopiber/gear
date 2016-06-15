#!/bin/bash


echo "Module As Project CLI"

base="/var/www/gear-package"
modulepath="$base/my-module"

php public/index.php gear schema delete MyModule $base
php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $modulepath && script/deploy-development.sh

cd $modulepath && node_modules/.bin/gulp optimize

cd $modulepath && php public/index.php gear cache renew --memcached

cd $modulepath && ant jshint
cd $modulepath && ant jshint-ci
cd $modulepath && ant karma
cd $modulepath && ant protractor