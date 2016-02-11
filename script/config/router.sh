#!/bin/bash
# MODULE

module=Integration
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"
index="public/index.php"

cd $gear && sudo php public/index.php gear schema delete $module $basePath
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath
#####################################################################################################################
cd $gear && sudo php $index gear module controller create $module $basePath --name="Internacional" --object="%s\Controller\Internacional"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="BiLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="TriBrasileiro"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="TetraGaucho"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="OctaGaucho"

cat $modulePath/config/ext/route.config.php
cat $modulePath/config/ext/navigation.config.php

exit 1



# TABLE
table="AllColumnsNames"

# COLUMNS
columns="{\"varchar_upload_one\" : \"upload-image\", \"varchar_upload_two\" : \"upload-image\", \"email_mensagem\" : \"email\", \"mensagem_da_mensagem\" : \"html\"}"

# MIGRATION
migration="20160123222058_all_columns"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration