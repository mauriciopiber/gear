#!/bin/bash

# MODULE
module=AllColumns
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
#####################################################################################################################


##=================================================

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper001" --type="ViewHelper"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper002" --type="ViewHelper" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper003" --type="ViewHelper"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper004" --type="ViewHelper" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelper005" --type="ViewHelper"  

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory001" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory002" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory003" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory004" --type="ViewHelper" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactory005" --type="ViewHelper" --service="factories"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace001" --type="ViewHelper" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace002" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace003" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace004" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFactoryNamespace005" --type="ViewHelper" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace001" --type="ViewHelper" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace002" --type="ViewHelper" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace003" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace004" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperNamespace005" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam001" --type="ViewHelper" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam002" --type="ViewHelper" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\ViewHelperDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam003" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ViewHelperDepNam001,Namespace1\\Namespace2\\ViewHelperDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam004" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\ViewHelperDepNam001,Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNam005" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\ViewHelperDepNam001,Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ViewHelperDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam001" --type="ViewHelper" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam002" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\ViewHelperFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam003" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\ViewHelperFacDepNam001,Namespace1\\Namespace2\\ViewHelperFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam004" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\ViewHelperFacDepNam001,Namespace1\\Namespace2\\ViewHelperFacDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperFacDepNam005" --type="ViewHelper" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\ViewHelperFacDepNam001,Namespace1\\Namespace2\\ViewHelperFacDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ViewHelperFacDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends001" --type="ViewHelper" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends002" --type="ViewHelper" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\ViewHelperDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends003" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\ViewHelperDepNam001" --dependency="Namespace1\\Namespace2\\ViewHelperDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends004" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\ViewHelperDepNam001"  --dependency="Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ViewHelperDepNamExtends005" --type="ViewHelper" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\ViewHelperDepNam001" --dependency="Namespace1\\Namespace2\\ViewHelperDepNam002,Namespace1\\Namespace2\\Namespace3\\ViewHelperDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\ViewHelperDepNam004"

cd $modulePath && ant dev && exit 1