#!/bin/bash

baseGear=${1}
basePath=${2}
modulePath=${3}
module=${4}
moduleUrl=${5}
table=${6}
columns=${7}
migrations=${8}

cd $baseGear

cp $baseGear/script/sandbox/migrations/$migrations.php $modulePath/data/migrations/

cd $modulePath
vendor/bin/phinx migrate


cd $baseGear


echo $module
echo $moduleUrl
echo $modulePath
echo $table
echo $columns
echo $migrations

php public/index.php gear module db create $module $basePath --table=$table --columns="$columns"



cd $modulePath
$modulePath/script/load.sh
ant