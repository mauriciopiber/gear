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
rm -R $modulePath/public
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath

#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
##########################################################


cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service001" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller001" --type="Controller" --dependency="Service\\Service001"


cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service011" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service021" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service031" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller002" --type="Controller" --dependency="Service\\Service011,Service\\Service021,Service\\Service031"


cd $modulePath && ant jshint
cd $modulePath && ant karma
exit 1

cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespace001" --type="Controller" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespace002" --type="Controller" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespace003" --type="Controller" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespace004" --type="Controller" --namespace="Namespace4"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespace005" --type="Controller" --namespace="Namespace4"


cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespace001" --type="Service" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespace002" --type="Service" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespace003" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespace004" --type="Service" --namespace="Namespace4"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespace005" --type="Service" --namespace="Namespace4"



cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller001" --type="Controller"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller002" --type="Controller"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller003" --type="Controller"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller004" --type="Controller"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Controller005" --type="Controller"

cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service001" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service002" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service003" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service004" --type="Service"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="Service005" --type="Service"

cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespaceDependency001" --type="Service" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespaceDependency002" --type="Service" --namespace="Namespace2" --dependency="Namespace1\\ServiceNamespace001"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespaceDependency003" --type="Service" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ServiceNamespace001,Namespace2\\ServiceNamespace002"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespaceDependency004" --type="Service" --namespace="Namespace4" --dependency="Namespace2\\ServiceNamespace002"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ServiceNamespaceDependency005" --type="Service" --namespace="Namespace5" --dependency="Namespace4\\ServiceNamespace004"


cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespaceDependency001" --type="Controller" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespaceDependency002" --type="Controller" --namespace="Namespace2" --dependency="Namespace1\\ControllerNamespace001"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespaceDependency003" --type="Controller" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ControllerNamespace001,Namespace2\\ControllerNamespace002"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespaceDependency004" --type="Controller" --namespace="Namespace4" --dependency="Namespace2\\ControllerNamespace002"
cd $gear && sudo php public/index.php gear module app create $module $basePath --name="ControllerNamespaceDependency005" --type="Controller" --namespace="Namespace5" --dependency="Namespace4\\ControllerNamespace004"


exit 1
