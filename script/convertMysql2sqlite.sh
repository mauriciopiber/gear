#!/bin/bash
scriptFolder=${1}
projectFolder=${2}
username=${3}
password=${4}
database=${5}
sqlite=${6}

/bin/sh $scriptFolder/mysql2sqlite.sh  -u $username -p$password $database | sqlite3 $sqlite
mv $sqlite $projectFolder/data
chmod 777 $projectFolder/data/$sqlite
ls -l $projectFolder/data
cd $projectFolder
php public/index.php gear project deploy testing-dev
vendor/bin/doctrine-module orm:schema-tool:update --force
php public/index.php gear project deploy development
#php public/index.php gear project deploy development