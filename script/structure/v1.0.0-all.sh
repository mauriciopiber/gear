#!/bin/bash

# MODULE
module=Integration
moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
gear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"
index="public/index.php"
#####################################################################################################################
echo "1. Criar Módulo"
cd $gear && sudo php public/index.php gear schema delete $module $basePath
cd $gear && sudo php public/index.php gear module-as-project create $module $basePath


#####################################################################################################################
echo "2. Instalar Módulo"
cd $modulePath && sudo $modulePath/script/deploy-development.sh
#####################################################################################################################


echo "3. Criar Src"


cd $gear && sudo php $index gear module controller create $module $basePath --name="Internacional" --service="%s\Controller\Internacional"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="BiLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="TriBrasileiro"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="TetraGaucho"
cd $gear && sudo php $index gear module activity create $module $basePath Internacional --name="OctaGaucho"

cd $gear && sudo php $index gear module controller create $module $basePath --name="Gremio" --object="%s\Controller\Gremio"
cd $gear && sudo php $index gear module activity create $module $basePath Gremio --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath Gremio --name="BiLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath Gremio --name="Brasileiro"
cd $gear && sudo php $index gear module activity create $module $basePath Gremio --name="HeptaGaucho"

cd $gear && sudo php $index gear module controller create $module $basePath --name="SaoPaulo" --object="%s\Controller\SaoPaulo"
cd $gear && sudo php $index gear module activity create $module $basePath SaoPaulo --name="TriCampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath SaoPaulo --name="TriLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath SaoPaulo --name="HexaBrasileiro"

cd $gear && sudo php $index gear module controller create $module $basePath --name="Corinthians" --object="%s\Controller\Corinthians"
cd $gear && sudo php $index gear module activity create $module $basePath Corinthians --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath Corinthians --name="Libertadores"
cd $gear && sudo php $index gear module activity create $module $basePath Corinthians --name="TetraBrasileiro"

cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdService" --type="Service"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdRepository" --type="Repository"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondForm" --type="Form"
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdForm" --type="Form"

cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyTest/MyAaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MySecond/MyBaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyCaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyDaaaUnitTest.php

#####################################################################################################################
echo "4. Configuração"
cd $modulePath && sudo $modulePath/script/load.sh 
#####################################################################################################################
echo "5. Teste"
cd $modulePath && ant dev
#dev

#criar um módulo
#criar 5 src repository
#criar 5 src service
#criar 5 src form
#criar 5 src filter
#criar 5 src factory
#criar 5 controller
#criar 5 actions para cada controller


#rodar build