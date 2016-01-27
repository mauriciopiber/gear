#!/bin/bash

baseGear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"

module="SandboxContact"
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)

#Criar novo módulo
sudo php public/index.php gear module-as-project create $module $basePath

#Copiar Migration
cp $baseGear/script/sandbox/migrations/20160123222054_contact.php $basePath/$moduleUrl/data/migrations/

cd $basePath/$moduleUrl
#instalar módulo
script/deploy-development.sh


cd $baseGear

#criar ítens do gear.
php public/index.php gear module db create SandboxContact /var/www/gear-package --table=Contato --columns="{\"email\" : \"email\", \"mensagem\" : \"html\"}"

cd $basePath/$moduleUrl
$basePath/$moduleUrl/script/load.sh
ant