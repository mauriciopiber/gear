# MODULE
module=AllColumns


# MIGRATION
migrations=20160123222064_tinyint_db


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
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222058_date_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222059_datetime_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222060_time_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222061_text_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222062_decimal_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222063_int_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222064_tinyint_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222065_varchar_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/20160123222066_upload_image_db.php $baseModule/data/migrations/

#####################################################################################################################
echo "4. Instalar banco"
cd $baseModule && vendor/bin/phinx migrate
cd $baseModule && sudo php public/index.php gear database fix

columns="{\"date_ptbr\" : \"date_pt_br\", \"datetime_ptbr\" : \"datetime_pt_br\", \"decimal_ptbr\" : \"money-pt-br\", \"checkbox\" : \"checkbox\", \"checkbox_req\" : \"checkbox\", \"text_ptbr\" : \"html\", \"tinyint_ptbr\" : \"checkbox\", \"email_one\" : \"email\", \"email_two\" : \"email\", \"password_verify_one\" : \"password-verify\", \"password_verify_two\" : \"password_verify\",\"unique_id_one\" : \"uniqueId\", \"unique_id_two\" : \"unique id\", \"upload_image_one\" : \"upload-image\", \"upload_image_two\" : \"upload_image\"}"

#####################################################################################################################
echo "5. Criar Crud"

##1
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDbMix --columns="$columns"

cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DateDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DateDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DateDbMix --columns="$columns"
##3
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DatetimeDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DatetimeDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DatetimeDbMix --columns="$columns"
##4
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DecimalDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DecimalDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DecimalDbMix --columns="$columns"
##5
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDbMix --columns="$columns"
##6
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TextDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TextDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TextDbMix --columns="$columns"
##7
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TimeDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TimeDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TimeDbMix --columns="$columns"
##8
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDb  --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDbMix --columns="$columns"

cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TableUploadImage 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TableUploadImageReq
#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant phpunit-benchmark