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
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222058_date_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222059_datetime_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222060_time_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222061_text_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222062_decimal_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222063_int_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222064_tinyint_db.php $baseModule/data/migrations/
cd $baseGear && sudo cp $baseGear/script/db-structure/migrations/20160123222065_varchar_db.php $baseModule/data/migrations/

#####################################################################################################################
echo "4. Instalar banco"
cd $baseModule && vendor/bin/phinx migrate
cd $baseModule && sudo php public/index.php gear database fix


#####################################################################################################################
echo "5. Criar Crud"

##1
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TinyintDbMix


#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant phpunit-benchmark
exit 1
##2
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DateDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DateDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DateDbMix
##3
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DatetimeDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DatetimeDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DatetimeDbMix
##4
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DecimalDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DecimalDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=DecimalDbMix
##5
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=IntDbMix
##6
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TextDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TextDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TextDbMix
##7
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TimeDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TimeDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=TimeDbMix
##8
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDb 
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDbReq
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=VarcharDbMix


#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant phpunit-benchmark