#!/bin/bash

database="my_project"
username="root"
password="gear"
basepath="/var/www"

project="GearProject"

projectpath="$basepath/$project"

php public/index.php gear project create GearProject --database=$database --username=$username --password=$password --basepath=$basepath

ls -l $projectpath

cd $projectpath && php public/index.php gear project diagnostic