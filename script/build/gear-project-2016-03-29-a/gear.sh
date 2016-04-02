#!/bin/bash
module=Build
migrations=20160123222067_all_columns_db

moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)

basepath="/var/www/gear-project"
project="GearProject"
projectpath="$basepath/$project"

host="gear-project.gear.dev"

environment="development"

database="gear_project"
username="root"
password="gear"

git="git@bitbucket.org:mauriciopiber/gearproject-2016-04-01.git"


# CRIAR PROJETO

php public/index.php gear project create GearProject --host=$host --git=$git --database=$database --username=$username --password=$password --basepath=$basepath

# CRIAR MÓDULO
cd $projectpath && sudo php public/index.php gear module create $module
cd $projectpath && ant 


exit 1
# COPIAR MIGRATION
sudo cp $baseGear/script/build/gear-project-2016-03-29-a/$migrations.php $baseModule/data/migrations/

# MIGRAR
cd $baseModule && vendor/bin/phinx migrate

# ARRUMAR DB
cd $baseModule && sudo php public/index.php gear database fix

# CRIAR DB
columns="{\"date_ptbr\" : \"date_pt_br\", \"datetime_ptbr\" : \"datetime_pt_br\", \"decimal_ptbr\" : \"money-pt-br\", \"checkbox\" : \"checkbox\", \"checkbox_req\" : \"checkbox\", \"text_ptbr\" : \"html\", \"tinyint_ptbr\" : \"checkbox\", \"email_one\" : \"email\", \"email_two\" : \"email\", \"password_verify_one\" : \"password-verify\", \"password_verify_two\" : \"password_verify\",\"unique_id_one\" : \"uniqueId\", \"unique_id_two\" : \"unique id\", \"upload_image_one\" : \"upload-image\", \"upload_image_two\" : \"upload_image\"}"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=AllColumnsDb --columns="$columns"

cd $projectpath && ant 

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



