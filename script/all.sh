#!/bin/bash
php ./../../public/index.php gear controller create TestConstructor --name=FirstController --invokable=%s\Controller\First

php ./../../public/index.php gear module delete TestConstructor
php ./../../public/index.php gear module create TestConstructor

cat ./../TestConstructor/schema/module.json

php ./../../public/index.php gear controller create TestConstructor --name=SecondController --invokable=%s\Controller\Second
php ./../../public/index.php gear controller create TestConstructor --name=ThirdController --invokable=%s\Controller\Third

php ./../../public/index.php gear activity create TestConstructor FirstController --name=MyFirstAction
php ./../../public/index.php gear activity create TestConstructor FirstController --name=MySecondAction
php ./../../public/index.php gear activity create TestConstructor FirstController --name=MyThirdAction

php ./../../public/index.php gear view create TestConstructor --targetDir=partial/test.phtml
php ./../../public/index.php gear view create TestConstructor --targetDir=temp/temp.phtml

php ./../../public/index.php gear test create TestConstructor --suite=acceptance --targetDir=tempdir/test.php
php ./../../public/index.php gear test create TestConstructor --suite=functional --targetDir=tempdir2/test2.php
php ./../../public/index.php gear test create TestConstructor --suite=unit  --targetDir=tempdir3/test3.php

exit 1
phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/FirstControllerTest.php
phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/SecondControllerTest.php
phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/ThirdControllerTest.php


sudo ant phpunit



php ./../../public/index.php gear activity create TestConstructor SecondController --name=MyFirstAction
php ./../../public/index.php gear activity create TestConstructor SecondController --name=MySecondAction
php ./../../public/index.php gear activity create TestConstructor SecondController --name=MyThirdAction

php ./../../public/index.php gear activity create TestConstructor ThirdController --name=MyFirstAction
php ./../../public/index.php gear activity create TestConstructor ThirdController --name=MySecondAction
php ./../../public/index.php gear activity create TestConstructor ThirdController --name=MyThirdAction



exit 1

#phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/BuildControllerTest.php
#php ./../../public/index.php gear build PiberUnit --build=dev
#php ./../../public/index.php gear build PiberUnit --build="phpcs,phpmd,phpcpd"

#
#
#
php ./../../public/index.php gear project setUpEntity PiberUnit --entity="Module,Controller"


php ./../../public/index.php gear project setUpConfig --environment="development" --host="modules.gear.dev" --dbname="mydatabase" --dbms="mysql" --username="root" --password="gear"
php ./../../public/index.php gear project setUpGlobal --host="modules.gear.dev" --dbname="mydatabase" --dbms="mysql" --environment="development"
php ./../../public/index.php gear project setUpLocal --username="root" --password="gear"
php ./../../public/index.php gear project setUpEnvironment --environment="development"
php ./../../public/index.php gear project setUpMysql --dbname="mydatabase"  --username="root" --password="gear"
php ./../../public/index.php gear project setUpSqlite --dbname="mydatabase"  --username="root" --password="gear" --dump="/tmp"

php ./../../public/index.php gear -v
php ./../../public/index.php gear --version

php ./../../public/index.php gear module create PiberUnit
php ./../../public/index.php gear unload PiberUnit
php ./../../public/index.php gear load PiberUnit
php ./../../public/index.php gear load --before="Gear" PiberUnit
php ./../../public/index.php gear unload PiberUnit
php ./../../public/index.php gear module delete PiberUnit