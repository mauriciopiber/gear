#!/bin/bash

database="my_project"
username="root"
password="gear"
basepath="/var/www"

project="GearProject"

projectpath="$basepath/$project"

sudo php public/index.php gear project create GearProject --database=$database --username=$username --password=$password --basepath=$basepath 

cd $projectpath && sudo script/deploy-development.sh

cd $projectpath && sudo php public/index.php gear module create OneTwo
cd $projectpath && sudo php public/index.php gear module create ThreeFour
cd $projectpath && sudo php public/index.php gear module create FiveSix
cd $projectpath && sudo php public/index.php gear module create SevenEight
cd $projectpath && sudo php public/index.php gear module create NineTen

cd $projectpath && sudo php public/index.php gear project setUpAcl --memcached

cd $projectpath && node_modules/.bin/gulp optimize

cd $projectpath && ant