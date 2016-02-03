#!/bin/bash


baseGear=${1}
basePath=${2}
modulePath=${3}
module=${4}
moduleUrl=${5}

cd $baseGear

sudo php public/index.php gear module-as-project create $module $basePath

cd $modulePath
sudo $modulePath/script/deploy-development.sh