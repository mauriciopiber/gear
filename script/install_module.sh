# MODULE
module=${1}

# TABLE
table=${2}

# COLUMNS
columns=${3}

# MIGRATION
migrations=${4}

moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"

#####################################################################################################################
echo "1. Criar Módulo"
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath
#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
#####################################################################################################################
echo "3. Copiar banco"
cd $gear && sudo cp $gear/script/sandbox/migrations/$migrations.php $modulePath/data/migrations/
#####################################################################################################################
echo "4. Instalar banco"
cd $modulePath && vendor/bin/phinx migrate
#####################################################################################################################
echo "5. Criar Crud"
cd $gear && sudo php public/index.php gear module db create $module $basePath --table=$table --columns="$columns"
#####################################################################################################################
echo "6. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "7. Teste"
ant