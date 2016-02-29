# MODULE
module=AllColumns


# MIGRATION
migrations=20160123222065_varchar_db


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
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/$migrations.php $baseModule/data/migrations/
#####################################################################################################################
echo "4. Instalar banco"
cd $baseModule && vendor/bin/phinx migrate
cd $baseModule && vendor/bin/unload-module BjyAuthorize
cd $baseModule && sudo php public/index.php gear database fix

columns="{\"email_one\" : \"email\", \"email_two\" : \"email\", \"password_verify_one\" : \"password-verify\", \"password_verify_two\" : \"password_verify\",\"unique_id_one\" : \"uniqueId\", \"unique_id_two\" : \"unique id\", \"upload_image_one\" : \"upload-image\", \"upload_image_two\" : \"upload_image\"}"

##\"telephone_one\" : \"telephone\", \"telephone_two\" : \"telephone\",\"url_one\" : \"url\", \"url_two\" : \"url\"

#####################################################################################################################
echo "5. Criar Crud"

cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDbMix --columns="$columns"

#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant unit