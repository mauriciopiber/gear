#!/bin/bash

# MODULE
module=AppSrc
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"
index="public/index.php"
#####################################################################################################################
echo "1. Criar Módulo"
cd $gear && sudo php public/index.php gear schema delete $module $basePath
rm -R $modulePath/config
rm -R $modulePath/src
rm -R $modulePath/test/unit
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath

#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
##########################################################

cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action002"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action004"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action005"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action006"

echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
exit 1 

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service001" --type="Service" --service="factories" --namespace="Namespace1"
cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller113"

cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller005" --service="factories" --namespace=Namespace1 --extends=Controller\\Controller113
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action001" --dependency="Namespace1\\Service001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action002" --dependency="Namespace1\\Service001"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service002" --type="Service" --service="factories" --namespace="Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Service003" --type="Service" --service="factories" --namespace="Namespace3"

cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action003" --dependency="Namespace2\\Service002"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action004" --dependency="Namespace3\\Service003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action005"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action006"



echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
exit 1 

exit 1



echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
exit 1 

cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller005" --service="factories" --namespace=Namespace1 --extends=Controller\\Controller113
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action002" --dependency="Namespace1\\Service001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action003" 
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action004" --dependency="Namespace3\\Service003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action005" --dependency="Namespace1\\Service001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller005 --name="Action006" --dependency="Namespace2\\Service002"

echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
exit 1

exit 1

###@@@@@@@@@@@@@@@============

cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action002"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action004"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action005"
cd $gear && sudo php $index gear module activity create $module $basePath Controller001 --name="Action006"

cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller002" --service="factories"
cd $gear && sudo php $index gear module activity create $module $basePath Controller002 --name="Action001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller002 --name="Action002"
cd $gear && sudo php $index gear module activity create $module $basePath Controller002 --name="Action003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller002 --name="Action004"
cd $gear && sudo php $index gear module activity create $module $basePath Controller002 --name="Action005"
cd $gear && sudo php $index gear module activity create $module $basePath Controller002 --name="Action006"


cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller003" --service="factories" --namespace=Namespace1
cd $gear && sudo php $index gear module activity create $module $basePath Controller003 --name="Action001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller003 --name="Action002"
cd $gear && sudo php $index gear module activity create $module $basePath Controller003 --name="Action003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller003 --name="Action004"
cd $gear && sudo php $index gear module activity create $module $basePath Controller003 --name="Action005"
cd $gear && sudo php $index gear module activity create $module $basePath Controller003 --name="Action006"



cd $gear && sudo php $index gear module controller create $module $basePath --name="Controller004" --service="factories" --namespace=Namespace1 --extends=Controller\\Controller113
cd $gear && sudo php $index gear module activity create $module $basePath Controller004 --name="Action001"
cd $gear && sudo php $index gear module activity create $module $basePath Controller004 --name="Action002"
cd $gear && sudo php $index gear module activity create $module $basePath Controller004 --name="Action003"
cd $gear && sudo php $index gear module activity create $module $basePath Controller004 --name="Action004"
cd $gear && sudo php $index gear module activity create $module $basePath Controller004 --name="Action005"
cd $gear && sudo php $index gear module activity create $module $basePath Controller004 --name="Action006"

echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev

exit 1
