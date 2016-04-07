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



cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository001" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository002" --type="Repository" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository003" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository004" --type="Repository" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Repository005" --type="Repository"  


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory001" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory002" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory003" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory004" --type="Repository" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactory005" --type="Repository" --service="factories"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace001" --type="Repository" --service="factories" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace002" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace003" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace004" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFactoryNamespace005" --type="Repository" --service="factories" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace001" --type="Repository" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace002" --type="Repository" --namespace="Namespace1\\Namespace2"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace003" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace004" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryNamespace005" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam001" --type="Repository" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam002" --type="Repository" --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\RepositoryDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam003" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\RepositoryDepNam001,Namespace1\\Namespace2\\RepositoryDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam004" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\RepositoryDepNam001,Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNam005" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\RepositoryDepNam001,Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\RepositoryDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam001" --type="Repository" --service=factories --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam002" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2" --dependency="Namespace1\\RepositoryFacDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam003" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3" --dependency="Namespace1\\RepositoryFacDepNam001,Namespace1\\Namespace2\\RepositoryFacDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam004" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4"  --dependency="Namespace1\\RepositoryFacDepNam001,Namespace1\\Namespace2\\RepositoryFacDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryFacDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryFacDepNam005" --type="Repository" --service=factories --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --dependency="Namespace1\\RepositoryFacDepNam001,Namespace1\\Namespace2\\RepositoryFacDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryFacDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\RepositoryFacDepNam004"


cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends001" --type="Repository" --namespace="Namespace1"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends002" --type="Repository" --namespace="Namespace1\\Namespace2" --extends="Namespace1\\RepositoryDepNam001"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends003" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3" --extends="Namespace1\\RepositoryDepNam001" --dependency="Namespace1\\Namespace2\\RepositoryDepNam002"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends004" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4" --extends="Namespace1\\RepositoryDepNam001"  --dependency="Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RepositoryDepNamExtends005" --type="Repository" --namespace="Namespace1\\Namespace2\\Namespace3\\Namespace4\\namespace5" --extends="Namespace1\\RepositoryDepNam001" --dependency="Namespace1\\Namespace2\\RepositoryDepNam002,Namespace1\\Namespace2\\Namespace3\\RepositoryDepNam003,Namespace1\\Namespace2\\Namespace3\\Namespace4\\RepositoryDepNam004"

cd $modulePath && ant dev && exit 1
