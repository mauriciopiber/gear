#!/bin/bash

base="/var/www/gear-package"
modulepath="$base/my-module"

#rm $modulepath;

php public/index.php gear module-as-project create MyModule $base --type=web --force

cd $modulepath && script/deploy-development.sh

cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web


exit 1



