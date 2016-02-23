#!/bin/bash

php public/index.php gear module src create Gear --name="AppServiceSpecService" --extends="Mvc\\AbstractMvcTest"
php public/index.php gear module src create Gear --name="AppControllerSpecService" --extends="Mvc\\AbstractMvcTest"  

php public/index.php gear module src create Gear --name="AppServiceService" --extends="Mvc\\AbstractMvc" --dependency="Mvc\\View\\App\\AppServiceSpecService"
php public/index.php gear module src create Gear --name="AppControllerService" --extends="Mvc\\AbstractMvc"  --dependency="Mvc\\View\\App\\AppControllerSpecService"

php public/index.php gear module src create Gear --name="AppService" --type="Service" --namespace=Constructor\\App --dependency="Mvc\\View\\App\\AppServiceService,Mvc\\View\\App\\AppControllerService,\GearJson\Schema\SchemaService"

php public/index.php gear module controler create Gear --name="AppController" --type=Console --namespace=Constructor\\App
php public/index.php gear module activity create Gear AppController --name="create" --dependency="Constructor\\App\\AppService" 
php public/index.php gear module activity create Gear AppController --name="delete"

ant unit
exit 1

