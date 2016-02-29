# MODULE
module=AllColumns


# MIGRATION
migrations=20160123222063_int_db


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
cd $baseModule && sudo php public/index.php gear database fix


#####################################################################################################################
echo "5. Criar Crud"

cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDepOne
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDepTwo
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDepThree
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDepFour
#cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDb 
#cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDbReq
#cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDbMix


#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant unit