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

sudo rm -R $modulepath/schema


#### Create

sudo php public/index.php gear module-as-project create $module $base --type=web --force

cd $modulepath && sudo script/deploy-development.sh

cd $modulepath && ant

