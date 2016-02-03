#!/bin/bash

# MODULE
module="SandboxContact"

# MIGRATION
migrations="20160123222054_contact"


### INSTALLER
#/bin/bash script/install_module.sh $module $table "$columns" $migration


moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
baseGear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
baseModule="$basePath/$moduleUrl"

#####################################################################################################################
echo "1. Criar Módulo"
cd $baseGear && sudo php public/index.php gear module-as-project create $module $basePath
#####################################################################################################################
echo "2. Instalar Módulo"
cd $baseModule && sudo $baseModule/script/deploy-development.sh
#####################################################################################################################
echo "3. Copiar banco"
cd $baseGear && sudo cp $baseGear/script/sandbox/migrations/$migrations.php $baseModule/data/migrations/
#####################################################################################################################
echo "4. Instalar banco"
cd $baseModule && vendor/bin/phinx migrate

#####################################################################################################################
echo "5. Criar Crud"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=Contato --columns="{\"email\" : \"email\", \"mensagem\" : \"html\"}"
cd $baseGear && sudo php public/index.php gear module db create $module $basePath --table=Mensagem --columns="{\"email_mensagem\" : \"email\", \"mensagem_da_mensagem\" : \"html\"}"
#####################################################################################################################
echo "6. Configuração"
cd $baseModule && sudo $baseModule/script/load.sh 
#####################################################################################################################
echo "7. Teste"
cd $baseModule && ant dev