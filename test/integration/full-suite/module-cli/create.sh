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

php public/index.php gear git repository delete $module

php public/index.php gear jenkins job delete $module

sudo rm -R $modulepath/.git
sudo rm -R $modulepath/schema

#### Create

sudo php public/index.php gear module-as-project create $module $base --type=cli --force

cd $modulepath && sudo script/deploy-development.sh

### can be turned off
###cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
###cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
###cd $modulepath && sudo php public/index.php gear database fix

### can be turned off
###cd $modulepath && sudo script/load.sh



cd $modulepath && ant


#### CREATE GIT.

#### INITIATE.

php public/index.php gear git repository create $module

php public/index.php gear git repository init

php public/index.php gear jenkins job create $module pipeline-dev

php public/index.php gear deploy build $module pipeline-dev

#### 

#### PUSH





