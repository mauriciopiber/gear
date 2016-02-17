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
#####################################################################################################################

#cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoService" --type="Service" --namespace="Minimo" --service=factory

#cd $modulePath && ant dev
#cat $modulePath/schema/module.json
#cat $modulePath/config/ext/servicemanager.config.php

#exit

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="BlumenauService" --type="Service" --service="factories"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FlorianopolisService" --type="Service" --service="factories"


#ls $modulePath/src/AppSrc/Service
#cat $modulePath/src/AppSrc/Service/BlumenauServiceFactory.php
#ls $modulePath/test/unit/AppSrcTest/ServiceTest

cd $modulePath && ant dev
cat $modulePath/config/ext/servicemanager.config.php

exit 1


## Comando Mínimo
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoService" --type="Service" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MaximoService" --type="Service" --namespace="Minimo\Application"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="PortoFelizService" --type="Service" --namespace="Minimo\Application"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SaoChicoService" --type="Service" --namespace="Minimo\Application"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RioDeFevereiro" --type="Service" --namespace="Minimo\Application"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="PortoAlegreService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SaoPauloService" --type="Service" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RioDeJaneiroService" --type="Service" 
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RioBrancoService" --type="Service" --extends="Service\RioDeJaneiroService" --dependency="Service\\SaoPauloService,Service\\PortoAlegreService"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="TaquaraService" --type="Service" --namespace="RioGrandeDoSul"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="NovoHamburgoService" --type="Service" --namespace="RioGrandeDoSul"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SaoLeopoldoService" --type="Service" --namespace="RioGrandeDoSul"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="EstrelaService" --type="Service" --extends="RioGrandeDoSul\\TaquaraService" --dependency="RioGrandeDoSul\\SaoLeopoldoService,RioGrandeDoSul\\NovoHamburgoService" --namespace="RioGrandeDoSul"
cd $modulePath && ant dev




cd $gear && sudo php public/index.php gear module src create $module $basePath --name="RioBranco" --type="Service" --namespace="Minimo\Application" --extends="Minimo\Application\RioDeJaneiro" --dependency="Minimo\\Application\\SaoPauloService, Minimo\\Application\PortoAlegreService"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="Jacarepagua" --type="Service" --namespace="Minimo\Application" --extends="\GearBase\Service\AbstractService"

#cat $modulePath/schema/module.json
cd $modulePath && ant dev

exit 1

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoRepository" --type="Repository" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoForm" --type="Form" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFilter" --type="Filter" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFactory" --type="Factory" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoValueObject" --type="ValueObject" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoControllerPlugin" --type="ControllerPlugin" --namespace="Minimo"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoViewHelper" --type="ViewHelper" --namespace="Minimo"


exit 1









## OK OK OK OK OK 
## Comando Mínimo
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFilter" --type="Filter"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFactory" --type="Factory"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoValueObject" --type="ValueObject"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoControllerPlugin" --type="ControllerPlugin"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoViewHelper" --type="ViewHelper"
cd $modulePath && ant unit-coverage






exit 1

#cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoFixture" --type="Fixture"
#cd $gear && sudo php public/index.php gear module src create $module $basePath --name="MinimoEntity" --type="Entity"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdForm" --type="Form"

#####################################################################################################################
echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
#dev