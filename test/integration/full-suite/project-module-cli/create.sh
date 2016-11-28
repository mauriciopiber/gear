#!/bin/bash


#### MODULE INFO

project="ProjectWeb"
projectUrl="project-web"

#### Path Config

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)

base="/var/www/gear-package"
path="$base/$projectUrl"
gearpath="$base/gear"

#### Remove

cd $path && php public/index.php gear git repository delete $project --force

cd $path && php public/index.php gear jenkins suite delete

sudo rm -R $path/.git
sudo rm -R $path/schema

#### Create

cd $gearpath && sudo php public/index.php gear project create $module $base --type=web --force

cd $path && sudo script/deploy-development.sh

### can be turned off
cd $path && sudo vendor/bin/phinx migrate

### can be turned off
cd $path && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
cd $path && sudo php public/index.php gear database fix

### can be turned off
cd $path && sudo script/load.sh

#cd $path && ant

echo "
*
!.gitignore" > build/.gitignore

echo "vendor" > .gitignore

#### CREATE GIT.

#### INITIATE.

cd $path && php public/index.php gear git repository create $project

cd $path && php public/index.php gear git repository init

cd $path && php public/index.php gear jenkins suite create $projectUrl

cd $path && php public/index.php gear deploy build "Primeiro Build com sucesso project"