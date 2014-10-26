#!/bin/bash
#php ./../../public/index.php gear setUpGlobal --host="modules.gear.dev" --dbname="mydatabase" --dbms="mysql" --environment="development"
#php ./../../public/index.php gear setUpLocal --username="root" --password="gear"
#php ./../../public/index.php gear setUpEnvironment --environment="development"
phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ServiceTest/ModuleTest/ModuleServiceTest.php
phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/GearControllerTest.php
phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/ModuleControllerTest.php
php ./../../public/index.php gear unload PiberUnit
exit 1

phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ValueObjectTest/ConfigTest/ConfigTest.php


php ./../../public/index.php gear -v
php ./../../public/index.php gear --version



php ./../../public/index.php gear module create PiberUnit
php ./../../public/index.php gear unload PiberUnit
php ./../../public/index.php gear load PiberUnit
php ./../../public/index.php gear load --before="Gear" PiberUnit
php ./../../public/index.php gear module delete PiberUnit

#phpunit --configuration=/var/www/html/modules/module/Gear/test/phpunit.xml test/GearTest/ControllerTest/BuildControllerTest.php
#php ./../../public/index.php gear build PiberUnit --build=dev
#php ./../../public/index.php gear build PiberUnit --build="phpcs,phpmd,phpcpd"

#
#
#
