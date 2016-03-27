#!/bin/bash

basepath="/var/www/gear-project"
project="CbProject"
projectpath="$basepath/$project"
host="cb.gear.dev"
environment="development"
database="cb"
username="root"
password="gear"
git="git@bitbucket.org:mauriciopiber/cb.git"

#php public/index.php gear project delete CbProject --host=cb.gear.dev --database=$database --basepath=$basepath
#php public/index.php gear project create CbProject --host=cb.gear.dev --git=$git --database=$database --username=root --password=gear --basepath=$basepath

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



