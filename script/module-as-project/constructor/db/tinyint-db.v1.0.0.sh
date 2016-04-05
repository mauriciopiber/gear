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
cd $baseGear && sudo cp $baseGear/script/module/constructor/db/migrations/$migrations.php $baseModule/data/migrations/
#####################################################################################################################
echo "4. Instalar banco"
cd $baseModule && vendor/bin/phinx migrate
cd $baseModule && sudo php public/index.php gear database fix

columns="{\"tinyint_ptbr\" : \"checkbox\"}"
#####################################################################################################################
echo "5. Criar Crud"

cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDb --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDbReq --columns="$columns"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDbMix --columns="$columns"


#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant unit