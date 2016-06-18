#!/bin/bash

database="my_project"
username="root"
password="gear"
basepath="/var/www"

project="GearProject"

projectpath="$basepath/$project"

sudo php public/index.php gear project create GearProject --database=$database --username=$username --password=$password --basepath=$basepath --force

cd $projectpath && sudo script/deploy-development.sh

cd $projectpath && sudo php public/index.php gear module create WebExample
cd $projectpath && sudo php public/index.php gear module create CliExample --type="cli"

cd $projectpath && ant