# MODULE
module=AllColumns


# MIGRATION
migrations=20160123222067_all_columns_db


moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
baseGear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
baseModule="$basePath/$moduleUrl"
cd $baseGear && sudo php public/index.php gear schema delete $module $basePath
#####################################################################################################################
echo "1. Criar Módulo"
cd $baseGear && sudo php public/index.php gear module-as-project create $module $basePath
#####################################################################################################################
echo "2. Instalar Módulo"
cd $baseModule && sudo $baseModule/script/deploy-development.sh
#####################################################################################################################
echo "3. Copiar banco"
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/$migrations.php $baseModule/data/migrations/
#####################################################################################################################
echo "4. Instalar banco"
cd $baseModule && vendor/bin/phinx migrate
cd $baseModule && sudo php public/index.php gear database fix

columns="{\"date_ptbr\" : \"date_pt_br\", \"datetime_ptbr\" : \"datetime_pt_br\", \"decimal_ptbr\" : \"money-pt-br\", \"checkbox\" : \"checkbox\", \"checkbox_req\" : \"checkbox\", \"text_ptbr\" : \"html\", \"tinyint_ptbr\" : \"checkbox\", \"email_one\" : \"email\", \"email_two\" : \"email\", \"password_verify_one\" : \"password-verify\", \"password_verify_two\" : \"password_verify\",\"unique_id_one\" : \"uniqueId\", \"unique_id_two\" : \"unique id\", \"upload_image_one\" : \"upload-image\", \"upload_image_two\" : \"upload_image\"}"

#####################################################################################################################
echo "5. Criar Crud"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDepThree
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDepFour
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=AllColumnsDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=AllColumnsDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=AllColumnsDbMix --columns="$columns"
#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant unit





