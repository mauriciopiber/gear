#!/bin/bash

database="my_project"
username="root"
password="gear"
basepath="/var/www"

project="GearProject"

projectpath="$basepath/$project"

sudo php public/index.php gear project create GearProject --database=$database --username=$username --password=$password --basepath=$basepath --force

cd $projectpath && sudo script/deploy-development.sh

cd $projectpath && php public/index.php gear project diagnostic


rm $projectpath/build.xml
rm $projectpath/package.json
rm $projectpath/composer.json


rm -R $projectpath/node_modules
rm -R $projectpath/script
rm -R $projectpath/data/logs
rm -R $projectpath/data/cache/configcache
rm -R $projectpath/public/upload
rm -R $projectpath/data/DoctrineModule/cache
rm -R $projectpath/data/DoctrineORMModule/Proxy
rm -R $projectpath/data/session
rm -R $projectpath/build

rm $projectpath/script/deploy-testing.sh
rm $projectpath/script/deploy-development.sh
rm $projectpath/script/deploy-production.sh
rm $projectpath/script/deploy-staging.sh
rm $projectpath/script/deploy-load.sh
rm $projectpath/package.json
rm $projectpath/gulpfile.js
rm $projectpath/data/config.json
rm $projectpath/mkdocs.yml
rm $projectpath/docs/index.md
rm $projectpath/README.md
rm $projectpath/codeception.yml

cd $projectpath && php public/index.php gear project diagnostic
  
cd $projectpath && php public/index.php gear project upgrade --force

cd $projectpath && php public/index.php gear project diagnostic

