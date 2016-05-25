#!/bin/bash

basepath="/var/www/gear-project"
project="GearProject"
projectpath="$basepath/$project"


host="gear-project.gear.dev"

environment="development"

database="gear_project"
username="root"
password="gear"

git="git@bitbucket.org:mauriciopiber/gearproject-2016-04-01.git"

php public/index.php gear project create GearProject --host=$host --git=$git --database=$database --username=$username --password=$password --basepath=$basepath


exit 1

cd $projectpath && php public/index.php gear project diagnostics
cd $projectpath && php public/index.php gear project dump-autoload

exit 1

cd $projectpath && php public/index.php gear project fixture --reset-autoincrement
cd $projectpath && php public/index.php gear project config --host=$host --dbname=$database  --username=$username --password=$password --environment=$environment --dbms=mysql
cd $projectpath && php public/index.php gear project global --host=$host --dbname=$database  --dbms=mysql --environment=$environment
cd $projectpath && php public/index.php gear project local --username=$username --password=$password 
cd $projectpath && php public/index.php gear project nfs
cd $projectpath && php public/index.php gear project virtual-host $environment
cd $projectpath && php public/index.php gear project git $git



