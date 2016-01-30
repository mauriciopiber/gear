#!/bin/bash

# MODULE
module=Integration
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
index="public/index.php"

echo "3. Criar Src"


cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first1.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first2.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first3.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first4.phtml
cd $gear && sudo php $index gear module view create $module $basePath --target=extra/first5.phtml

cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyTest/MyAaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MySecond/MyBaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyCaaaUnitTest.php
cd $gear && sudo php $index gear module test create $module $basePath --suite=unit --target=MyDaaaUnitTest.php



cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstService" --type="Service"
cat $modulePath/config/ext/servicemanager.config.php
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondService" --type="Service"
cat $modulePath/config/ext/servicemanager.config.php
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdService" --type="Service"
cat $modulePath/config/ext/servicemanager.config.php
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="FirstRepository" --type="Repository"
cat $modulePath/config/ext/servicemanager.config.php
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="SecondRepository" --type="Repository"
cat $modulePath/config/ext/servicemanager.config.php
cd $gear && sudo php public/index.php gear module src create $module $basePath --name="ThirdRepository" --type="Repository"
cat $modulePath/config/ext/servicemanager.config.php

exit

cd $gear && sudo php $index gear module controller create $module $basePath --name="Internacional" --object="%s\Controller\Internacional"
cd $gear && sudo php $index gear module activity create $module $basePath InternacionalController --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath InternacionalController --name="BiLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath InternacionalController --name="TriBrasileiro"
cd $gear && sudo php $index gear module activity create $module $basePath InternacionalController --name="TetraGaucho"
cd $gear && sudo php $index gear module activity create $module $basePath InternacionalController --name="OctaGaucho"

cd $gear && sudo php $index gear module controller create $module $basePath --name="Gremio" --object="%s\Controller\Gremio"
cd $gear && sudo php $index gear module activity create $module $basePath GremioController --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath GremioController --name="BiLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath GremioController --name="Brasileiro"
cd $gear && sudo php $index gear module activity create $module $basePath GremioController --name="HeptaGaucho"

cd $gear && sudo php $index gear module controller create $module $basePath --name="SaoPaulo" --object="%s\Controller\SaoPaulo"
cd $gear && sudo php $index gear module activity create $module $basePath SaoPauloController --name="TriCampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath SaoPauloController --name="TriLibertadores"
cd $gear && sudo php $index gear module activity create $module $basePath SaoPauloController --name="HexaBrasileiro"

cd $gear && sudo php $index gear module controller create $module $basePath --name="Corinthians" --object="%s\Controller\Corinthians"
cd $gear && sudo php $index gear module activity create $module $basePath CorinthiansController --name="CampeaoDoMundo"
cd $gear && sudo php $index gear module activity create $module $basePath CorinthiansController --name="Libertadores"
cd $gear && sudo php $index gear module activity create $module $basePath CorinthiansController --name="TetraBrasileiro"



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