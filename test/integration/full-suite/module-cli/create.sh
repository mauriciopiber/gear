#!/bin/bash


#### MODULE INFO

module="ModuleCli"
moduleUrl="module-cli"

#### Path Config

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

base="/var/www/gear-package"
modulepath="$base/$moduleUrl"
gearpath="$base/gear"

#### Remove

sudo rm -R $modulepath


#### Create

sudo php public/index.php gear module-as-project create $module $base --type=cli --force

cd $modulepath && sudo script/deploy-development.sh

### can be turned off
cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
cd $modulepath && sudo php public/index.php gear database fix


### can be turned off
cd $modulepath && sudo script/load.sh



cd $modulepath && ant

