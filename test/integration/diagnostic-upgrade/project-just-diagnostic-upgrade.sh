#!/bin/bash

basepath="/var/www/gear-package"
project="GearProject"
projectpath="$basepath/$project"

function clear()
{
    projectpath=${1}

    sudo rm  $projectpath/build.xml
    sudo rm  $projectpath/package.json
    sudo rm  $projectpath/composer.json

    sudo rm  -R $projectpath/script
    sudo rm  -R $projectpath/data/logs
    sudo rm  -R $projectpath/data/cache/configcache
    sudo rm  -R $projectpath/public/upload
    sudo rm  -R $projectpath/data/DoctrineModule/cache
    sudo rm  -R $projectpath/data/DoctrineORMModule/Proxy
    sudo rm  -R $projectpath/data/session
    sudo rm  -R $projectpath/build

    sudo rm  $projectpath/script/deploy-testing.sh
    sudo rm  $projectpath/script/deploy-development.sh
    sudo rm  $projectpath/script/deploy-production.sh
    sudo rm  $projectpath/script/deploy-staging.sh
    sudo rm  $projectpath/script/deploy-load.sh
    sudo rm  $projectpath/package.json
    sudo rm  $projectpath/gulpfile.js
    sudo rm  $projectpath/data/config.json
    sudo rm  $projectpath/mkdocs.yml
    sudo rm  $projectpath/docs/index.md
    sudo rm  $projectpath/README.md
    sudo rm  $projectpath/codeception.yml

}

sudo php public/index.php gear project create GearProject --basepath=$basepath --force

cd $projectpath && sudo script/deploy-development.sh

cd $projectpath && php public/index.php gear project diagnostic --just=composer
cd $projectpath && php public/index.php gear project diagnostic --just=npm
cd $projectpath && php public/index.php gear project diagnostic --just=file
cd $projectpath && php public/index.php gear project diagnostic --just=dir
cd $projectpath && php public/index.php gear project diagnostic --just=ant

clear $projectpath

cd $projectpath && php public/index.php gear project diagnostic --just=composer
cd $projectpath && php public/index.php gear project diagnostic --just=npm
cd $projectpath && php public/index.php gear project diagnostic --just=file
cd $projectpath && php public/index.php gear project diagnostic --just=dir
cd $projectpath && php public/index.php gear project diagnostic --just=ant

  
cd $projectpath && sudo php public/index.php gear project upgrade --force --just=composer
cd $projectpath && sudo php public/index.php gear project upgrade --force --just=npm
cd $projectpath && sudo php public/index.php gear project upgrade --force --just=dir
cd $projectpath && sudo php public/index.php gear project upgrade --force --just=file
cd $projectpath && sudo php public/index.php gear project upgrade --force --just=ant

cd $projectpath && php public/index.php gear project diagnostic --just=composer
cd $projectpath && php public/index.php gear project diagnostic --just=npm
cd $projectpath && php public/index.php gear project diagnostic --just=file
cd $projectpath && php public/index.php gear project diagnostic --just=dir
cd $projectpath && php public/index.php gear project diagnostic --just=ant


