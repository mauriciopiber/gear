#!/bin/bash


#### MODULE INFO

module="ModuleWeb"
moduleUrl="module-web"

#### Path Config

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

base="/var/www/gear-package"
modulepath="$base/$moduleUrl"
gearpath="$base/gear"

#### Remove


cd $modulepath && php public/index.php gear git repository delete $module --force
cd $modulepath && php public/index.php gear jenkins suite delete

sudo rm -R $modulepath/.git
sudo rm -R $modulepath/schema

#### Create

cd $gearpath && sudo php public/index.php gear module-as-project create $module $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh

### can be turned off
cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
cd $modulepath && sudo php public/index.php gear database fix

### can be turned off
cd $modulepath && sudo script/load.sh

#cd $modulepath && ant

echo "
*
!.gitignore" > build/.gitignore

echo "vendor" > .gitignore

#### CREATE GIT.

#### INITIATE.

cd $modulepath && php public/index.php gear git repository create $module

cd $modulepath && php public/index.php gear git repository init

cd $modulepath && php public/index.php gear jenkins suite create $moduleUrl

cd $modulepath && php public/index.php gear deploy build "Primeiro Build com sucesso módule web"







